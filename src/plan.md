functionalities to achieve.

1. create a model.

model format should be as below:

```php

class Student extends Model
{
    // This can be used to set the table name
    public $table = 'students';
    // columns
    public $name = CharField($length = 255);
    public $email = EmailField($length = 255);
    public $password = PasswordField($length = 255);
    public $created_at = DateTimeField($auto_now=true, $auto_now_add=true);

    public $user = ForeignKeyField('User', $on_delete='cascade');

    class Meta
    {
        // This can be used to set the primary key
        public $primary_key = 'id';
        // This can be used to set the table name
        public $table = 'students';
    }
}
```

2. Make migrations -> flying:

   > First check if the table is available in the db

   > If not, create the table

   > Get the table body from the model.

   > Get the table body from the database.

   > Compare the two.

   > If the table body is different, then create a migration.

   > Otherwise, the table is uptodate

3. Create a function that creates models.

e.g. create_model('Student')

And then this can be called as new JET->create_model('Student')

The function should:

1. Check if the model exists in models
2. Get the model params from the model
3. Create it

4. To resolve relationships.

We can create a table in the db which holds the ddl of the failed relationship.

After creating the model, we can create the relationships using this ddl and after creating the model, we can delete the ddl.


When one runs `php jet makemigrations`,
- Algorithm.
   - Get all the models created.
   - Populate their equivalent SQL
   - Compare them with what is in the database.
   - Where there is a change, categorise the change
   - Save the new change in a file called migrations
   - Stop.
  
When one runs `php jet migrate`,
- Algorithm
   - For each migration file in the migrations folder,
   - Check if the filename is in the database migrations table and for which action.
   - If it exists, that means the migration has already been applied.
   - otherwise, apply the migration, by actually performing the action
   - Save the filename of the completed action in the database model of migrations.
   
When one runs `php jet migrate rollback [num]`
- Algorithm.
   - This deletes the latest [num] of migrations in the migrations' table with their corresponding 
  files in the migrations' folder.
   - If [num] is not provided, then 1 is assumed.
  
When one runs `php jet runserver`,
- Algorithm
   - Check if there are un applied migrations.
   - Count them and notify the user about them.
   - There should at least be one migration even on a normal initiation of the library.

How shall I determine dependencies(fk, m2m, o2m)?
- Scenario
    - Imagine three tables course, student, school which 
  are created in the hierarchy student, course, school with
  student related to course which is also related to school.
    - student cannot be created before course, course cannot be
  created before school.

- Algorithm
    - An array of dependencies shall be created i.e on migrations,
each migration will indicate its dependencies
  e.g. 
```php 
class studentMigration{
    $depends = ['course', ...]
  }
  
class CourseMigration{
    $depends = ['School' ...]
}

class SchoolMigration{
    $depends = []
}
```

On migrating table student, course will be added in an array
like `['student', 'course', ..]` and the last table will be migrated first thus, 
`school->course->student`. Thus by the time student table is executed, all its dependencies will 
have already been generated already. 
~*Inspired by Django*
