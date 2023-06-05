<!-- Task 1:
Create a new Laravel project named "MigrationAssignment" using the Laravel command-line interface. -->
composer create-project --prefer-dist laravel/laravel MigrationAssignment

<!-- Task 2:
Within the project, create a new migration file named "create_products_table" that will be responsible for creating a table called "products" in the database. The "products" table should have the following columns: -->

php artisan make:migration create_products_table

Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->text('description');
            $table->timestamps();
        });


<!-- Task 3:
After creating the migration file, run the migration to create the "products" table in the database. -->

php artisan migrate

<!-- Task 4:
Modify the existing migration file "create_products_table" to add a new column called "quantity" to the "products" table. The "quantity" column should be an integer column and allow null values. -->
public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Existing columns...

            $table->integer('quantity')->nullable();
            // Add the new "quantity" column
        });
    }

<!-- Task 5:
Create a new migration file named "add_category_to_products_table" that will be responsible for adding a new column called "category" to the "products" table. The "category" column should be a string column with a maximum length of 50 characters. -->

php artisan make:migration add_category_to_products_table --table=products

public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category', 50)->after('quantity')->nullable();
            // Add the new "category" column after the "quantity" column
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
            // Rollback: drop the "category" column
        });
    }

 <!-- Task 6:
After creating the new migration file, run the migration to add the "category" column to the "products" table. -->

php artisan migrate

<!-- Task 7:
Create a new migration file named "create_orders_table" that will be responsible for creating a table called "orders" in the database. The "orders" table should have the following columns: -->
php artisan make:migration create_orders_table

Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });

<!-- Task 8:
After creating the migration file for the "orders" table, run the migration to create the "orders" table in the database. -->

php artisan migrate
