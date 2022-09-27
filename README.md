How To Set up Products API Project (Time Estimate: 2:30 hours)

This project has been setup with docker for easy installation and configuration.

1. copy the .env.example to .env file

2. Run the following in root of the project directory

    ```docker-compose up -d --build```

3. Run following command to run migration and import data

    ```bash setup.sh```
    
Sample API URLs:

For all products:

http://localhost:8080/api/products 

For all products of any category(vehicle or insurance):

http://localhost:8080/api/products?category=vehicle

For all products of any price(a value):

http://localhost:8080/api/products?price=89000


