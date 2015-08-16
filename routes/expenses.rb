get '/api/expenses' do
  Expense.all.to_json
end

get '/api/expenses/:id' do
  expense = Expense.get(params[:id])
  if expense.nil?
    halt 404
  end
  expense.to_json
end

post '/api/expenses' do
  body = JSON.parse request.body.read
    expense = Expense.create(
    user: body['user'],
    category: body['category'],
    description: body['description'],
    price: body['price'],
    date: body['date']
  )
  status 201
  expense.to_json 
end

put '/api/expenses/:id' do
  body = JSON.parse request.body.read
  expense = Expense.get(params[:id])
  if expense.nil?
    halt 404
  end
  halt 500 unless Expense.update(
    user: body['user'],
    category: body['category'],
    description: body['description'],
    price: body['price'],
    date: body['date'] 
  )
  expense.to_json
end

delete '/api/expenses/:id' do
  expense = Expense.get(params[:id])
  if expense.nil?
    halt 404
  end
  halt 500 unless expense.destroy
end
