require 'json'
require 'sinatra'
require 'data_mapper'
require 'dm-migrations'
require 'psych'

configure :development do
  DataMapper::Logger.new($stdout, :debug)
  DataMapper.setup(:default, ENV['DATABASE_URL'] || "sqlite3://#{Dir.pwd}/development.db")
end 

require './models/init' 
require './routes/init'

get '/' do
  send_file File.join(settings.public_folder, 'index.html')
end

not_found do
  status 404
  erb :not_found
end

DataMapper.finalize
