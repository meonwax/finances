class Expense
  include DataMapper::Resource

  property :id, Serial
  property :user, String, :required => true
  property :category, String, :required => true
  property :description, Text, :required => true
  property :price, Float, :required => true
  property :date, Date, :required => true
  property :created_at, DateTime
  property :updated_at, DateTime
end
