create extension if not exists pgcrypto;

create or replace function uuid_generate_v7()
returns uuid
as $$
declare
output       bytea;
  unixts       bytea = e'\\000\\000\\000\\000\\000\\000\\000\\000\\000';
timestamp    timestamptz;
  unix_time    bigint;
  microseconds int;
begin
timestamp    = clock_timestamp();
  unix_time    = floor(extract(epoch from timestamp))::bigint;
  microseconds = (cast(extract(microseconds from timestamp)::int - (floor(extract(seconds from timestamp))::int * 1000000) as double precision) * 16.777216)::int;

  unixts = set_byte(unixts, 0, (unix_time >> 28)::bit(8)::int);
  unixts = set_byte(unixts, 1, (unix_time >> 20)::bit(8)::int);
  unixts = set_byte(unixts, 2, (unix_time >> 12)::bit(8)::int);
  unixts = set_byte(unixts, 3, (unix_time >>  4)::bit(8)::int);
  unixts = set_byte(unixts, 4, ((unix_time::bit(4))||((microseconds >> 20)::bit(4)))::bit(8)::int);
  unixts = set_byte(unixts, 5, (microseconds >> 12)::bit(8)::int);
  unixts = set_byte(unixts, 6, (b'0111'||(microseconds >> 8)::bit(4))::bit(8)::int);
  unixts = set_byte(unixts, 7, microseconds::bit(8)::int);
  unixts = set_byte(unixts, 8, (b'10'||get_byte(gen_random_bytes(1), 0)::bit(6))::bit(8)::int);

output = unixts || gen_random_bytes(7);
return substring(output::text from 3)::uuid;
end
$$
language plpgsql
volatile;
