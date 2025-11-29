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
✔ 30 products created
✔ Search bar
✔ Filter by price range
✔ Filter by category
✔ Sorting
✔ Pastel professional UI (welcome page & product list)

Folder Structure:
app/
resources/
    views/
        layouts/
            app.blade.php
        components/
            layout.blade.php
        products/
            list.blade.php
            form.blade.php
            edit.blade.php
            show.blade.php
routes/
    web.php
public/
