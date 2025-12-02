School Product Management (Laravel Project)

Project Overview
This is a Laravel-based web application created for managing school payments and product items used by:
PKBM Bread of Life Adventist Homeschooler Community
Motto: “Nurture Together, Grow Together”

The application allows users to:
✔ available school products
✔ Search products by name or description
✔ Filter by category
✔ Filter by price range
✔ Sort products (by name or price)
✔ Add products (dummy mode)
✔ View product categories
✔ Enjoy a pastel-themed, modern UI

This project is created as part of the Progress Report 1 & 2 (Laravel Assignment).

Features Required by Assignment (All Completed)

Progress Report 1:
✔ ProductController
✔ Blade template
✔ Blade component
✔ Bootstrap styling
✔ Route /products → index()
✔ Route /products/create → create()
✔ Route /products/edit/{id} → edit()
✔ Route /products/store (POST) → store()
✔ Route /products/update/{id} (POST) → update()
✔ Route /products/show/{id} → show()
✔ Route group /products with controller
✔ Display 20+ random products using Blade directives
✔ “Add New Product” button
✔ Product form with name, description, price

Progress Report 2:
✔ 5 categories
✔ Display list of 30 predefined school products
✔ Search by name or description  
✔ Filter by:
  - Category  
  - Minimum price  
  - Maximum price  
✔ Sorting options:
  - Name (A–Z)
  - Price (Low → High)
  - Price (High → Low)

### This project is created as part of Module 8 (Seeding, Factory, and Faker).
- **Migration** for products table  
- **Seeder (ProductSeeder)** containing 30 real predefined products  
- **Factory (ProductFactory)** to generate optional dummy data  
- **DatabaseSeeder** runs:
  - ProductSeeder (real data)
  - Optional: ProductFactory for additional fake items  