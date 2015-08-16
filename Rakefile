require 'dm-migrations'

desc "Migrate the database"
task :migrate do
  require './main'
  DataMapper.auto_migrate!
end

desc "Upgrade the database"
task :upgrade do
  require './main'
  DataMapper.auto_upgrade! 
end

desc "List all routes"
task :routes do
  puts `grep '^[get|post|put|delete].*do$' routes/*.rb | sed 's/ do$//'`
end
