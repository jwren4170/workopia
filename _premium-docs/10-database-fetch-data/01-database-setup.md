# Setting Up Our Database

We will need to setup a database for our job listings and users. I will be using MySQL along with MySQL Workbench. If you do not have a connection setup in MySQL Workbench, do that now. I should you how to do that a couple of sections back.

## Create a Database/Schema

Now that we have a connection to our database, we can create a database. Click the `+` icon next to "SCHEMAS" to create a new database. Give the database a name. I will call mine `workopia`. Click "Apply" to create the database. You should see a success message. Now click "Apply" again and then click "Finish".

## Create Table & Fields/Columns

You should see your new database in the list of schemas. Click on it to select it and there will be a dropdown with the options 'Tables', 'Views', 'Stored Procedures' and 'Functions'. We will be using the 'Tables' option to create our tables. Right click on 'Tables' and select 'Create Table...'.

Let's call this table `listings` Then click in the box where the columns are and create your first column, which will be called `id`. For the datatype, select `INT(11)`. This is an integer with a max length of 11.

Make sure that `pk` is checked. This will make this column the primary key. This means that this column will be unique and will be used to identify each row in the table. `nn` should also be checked, which means that it can not be `null`. Also check the `ai` option, which means that this column will auto increment. This means that each time a new row is added to the table, this column will automatically be incremented by 1. This will ensure that each row has a unique id.

We are going to have a `users` table as well and we will create a relationship between the `listings` table, so let's create a column called `user_id` in the `listings` table. Give it a type of `INT(11)`. Make sure that `nn` is checked and `ai` is not checked.

Here are the rest of the fields with the datatypes. You can leave the defaults for the rest of the options.

- `title` - `VARCHAR(255)`
- `description` - `LONGTEXT`
- `salary` - `VARCHAR(45)`
- `tags` - `VARCHAR(255)`
- `company` - `VARCHAR(255)`
- `address` - `VARCHAR(255)`
- `city` - `VARCHAR(45)`
- `state` - `VARCHAR(45)`
- `phone` - `VARCHAR(45)`
- `email` - `VARCHAR(255)`
- `requirements` - `LONGTEXT`
- `benefits` - `LONGTEXT`
- `created_at` - TIMESTAMP - Default = CURRENT_TIMESTAMP

When you add the TIMESTAMP field, make sure there are no parenthesis after it. Then add `CURRENT_TIMESTAMP` in the Default/Expression column.

Once you add all of the fields, click 'apply' to save the table. You should see a success message. Click 'apply' again and then click 'finish'.

Now let's create the `users` table. Right click on 'Tables' and select `userCreate Table`. Let's call this table `users`. Then click in the box where the columns are and create your first column, which will be called `id`. For the datatype, select `INT(11)`. This is an integer with a max length of 11.

Add the following fields with the datatypes. You can leave the defaults for the rest of the options.

- `name` - `VARCHAR(255)`
- `email` - `VARCHAR(255)`
- `password` - `VARCHAR(255)`
- `city` - `VARCHAR(255)`
- `state` - `VARCHAR(255)`
- `created_at` - TIMESTAMP - Default = CURRENT_TIMESTAMP

You could add more fields later on, but this is a good start. Once you add all of the fields, click 'apply' to save the table. You should see a success message. Click 'apply' again and then click 'finish'.

## Create a Relationship

Now that we have our tables, we need to create a relationship between the `listings` table and the `users` table. Click on the `listings` table and then click on the 'Foreign Keys' tab down at the bottom.

Create a new foreign key. Give it a name of `fk_listings_users`. For the Reference Table, select `workopia.users`. Check the `user_id` column and then select `id` for the Reference Column.

For the `On Update` and `On Delete` options, choose `CASCADE`. This means that if a user has a job listing, the user will not be able to be deleted. This keeps rouge listings from floating around with no owner.

Click 'Apply' to save the foreign key. You should see a success message. Click 'Apply' again and then click 'Finish'.

## Adding Data

Now that we have our tables and relationships, we can add some data.

### Insert Users

Click on the `users` table and then right click and select `Select rows - Limit 1000`. This will open a new tab with a query that will select all of the rows from the `users` table.

Click on the `Form Editor` option on the right. Here you can add data to the table. Leave the `id` field blank. This will be auto incremented, so the first user will have an id of `1` and so on. Add a name, email, password, city and state. For now, the password will be plain text, but when we create our application, they will get hashed. Click 'Apply' to save the row. You should see a success message. Click 'Apply' again and then click 'Finish'.

Now if you click the little lightning bolt icon, it will run the query and you should see the row that you just added.

I have included an SQL query that you can run to insert the following 4 users. You can also insert them manually if you want.

#### User 1

- `id` - leave blank
- `name` - John Doe
- `email` - user1@gmail.com
- `password` - 123456
- `city` - Boston
- `state` - MA
- `created_at` - TIMESTAMP - Default = CURRENT_TIMESTAMP

#### User 2

- `id` - leave blank
- `name` - Jane Doe
- `email` - user2@gmail.com
- `password` - 123456
- `city` - San Francisco
- `state` - CA
- `created_at` - TIMESTAMP - Default = CURRENT_TIMESTAMP

#### User 3

- `id` - leave blank
- `name` - Steve Smith
- `email` - steve@gmail.com
- `password` - 123456
- `city` - Chicago
- `state` - IL
- `created_at` - TIMESTAMP - Default = CURRENT_TIMESTAMP


#### SQL Script

Run this query to insert the users:

```sql
INSERT INTO users (name, email, password, city, state, created_at)
VALUES
  ('John Doe', 'user1@gmail.com', '123456', 'Boston', 'MA', CURRENT_TIMESTAMP),
  ('Jane Doe', 'user2@gmail.com', '123456', 'San Francisco', 'CA', CURRENT_TIMESTAMP),
  ('Steve Smith', 'user3@gmail.com', '123456', 'Chicago', 'IL', CURRENT_TIMESTAMP);
```

### Insert Listings

Now let's add some data to the `listings` table. Click on the `listings` table and then right click and select `Select rows - Limit 1000`. This will open a new tab with a query that will select all of the rows from the `listings` table.

Select the form editor and add some listings. Here is some sample data that you can use. I put an SQL query at the bottom that you can simply run and it will insert all of the listings.

#### Job 1

- `id` - leave blank
- `user_id` - 1
- `title` - Software Engineer
- `description` - We are seeking a skilled software engineer to develop high-quality software solutions
- `salary` - 90000
- `tags` - development, coding, java, python
- `company` - Tech Solutions Inc.
- `address` - 123 Main St
- `city` - Albany
- `state` - NY
- `phone` - 348-334-3949
- `email` - info@techsolutions.com
- `requirements` - Bachelors degree in Computer Science or related field, 3+ years of software development experience
- `benefits` - Healthcare, 401(k) matching, flexible work hours

#### Job 2

- `id` - leave blank
- `user_id` - 2
- `title` - Marketing Specialist
- `description` - We are looking for a Marketing Specialist to create and manage marketing campaigns
- `salary` - 70000
- `tags` - marketing, advertising
- `company` - Marketing Pros
- `address` - 456 Market St
- `city` - San Francisco
- `state` - CA
- `phone` - 454-344-3344
- `email` - info@marketingpros.com
- `requirements` - Bachelors degree in Marketing or related field, experience in digital marketing
- `benefits` - Health and dental insurance, paid time off, remote work options

#### Job 3

- `id` - leave blank
- `user_id` - 3
- `title` - Web Developer
- `description` - Join our team as a Web Developer and create amazing web applications
- `salary` - 85000
- `tags` - web development, programming
- `company` - WebTech Solutions
- `address` - 789 Web Ave
- `city` - Chicago
- `state` - IL
- `phone` - 456-876-5432
- `email` - info@webtechsolutions.com
- `requirements` - Bachelors degree in Computer Science or related field, proficiency in HTML, CSS, JavaScript
- `benefits` - Competitive salary, professional development opportunities, friendly work environment

#### Job 4

- `id` - leave blank
- `user_id` - 1
- `title` - Data Analyst
- `description` - We are hiring a Data Analyst to analyze and interpret data for insights
- `salary` - 7500
- `tags` - data analysis, statistics
- `company` - Data Insights LLC
- `address` - 101 Data St
- `city` - Chicago
- `state` - IL
- `phone` - 444-555-5555
- `email` - info@datainsights.com
- `requirements` - Bachelors degree in Data Science or related field, strong analytical skills
- `benefits` - Health benefits, remote work options, casual dress code

#### Job 5

- `id` - leave blank
- `user_id` - 2
- `title` - Graphic Designer
- `description` - Join our creative team as a Graphic Designer and bring ideas to life
- `salary` - 70000
- `tags` - graphic design, creative
- `company` - CreativeWorks Inc.
- `address` - 234 Design Blvd
- `city` - Albany
- `state` - NY
- `phone` - 499-321-9876
- `email` - info@creativeworks.com
- `requirements` - Bachelors degree in Graphic Design or related field, proficiency in Adobe Creative Suite
- `benefits` - Flexible work hours, creative work environment, opportunities for growth

#### SQL Script

Run this query to insert all the listings. You have to make sure that the `user_id` is an actual id in the `users` table. Change them if needed.

```sql
INSERT INTO workopia.listings (user_id, title, description, salary, tags, company, address, city, state, phone, email, requirements, benefits, created_at)
VALUES
  (1, 'Software Engineer', 'We are seeking a skilled software engineer to develop high-quality software solutions', 90000, 'development, coding, java, python', 'Tech Solutions Inc.', '123 Main St', 'Albany', 'NY', '348-334-3949', 'info@techsolutions.com', 'Bachelors degree in Computer Science or related field, 3+ years of software development experience', 'Healthcare, 401(k) matching, flexible work hours', CURRENT_TIMESTAMP),
  (2, 'Marketing Specialist', 'We are looking for a Marketing Specialist to create and manage marketing campaigns', 70000, 'marketing, advertising', 'Marketing Pros', '456 Market St', 'San Francisco', 'CA', '454-344-3344', 'info@marketingpros.com', 'Bachelors degree in Marketing or related field, experience in digital marketing', 'Health and dental insurance, paid time off, remote work options', CURRENT_TIMESTAMP),
  (3, 'Web Developer', 'Join our team as a Web Developer and create amazing web applications', 85000, 'web development, programming', 'WebTech Solutions', '789 Web Ave', 'Chicago', 'IL', '456-876-5432', 'info@webtechsolutions.com', 'Bachelors degree in Computer Science or related field, proficiency in HTML, CSS, JavaScript', 'Competitive salary, professional development opportunities, friendly work environment', CURRENT_TIMESTAMP),
  (1, 'Data Analyst', 'We are hiring a Data Analyst to analyze and interpret data for insights', 7500, 'data analysis, statistics', 'Data Insights LLC', '101 Data St', 'Chicago', 'IL', '444-555-5555', 'info@datainsights.com', 'Bachelors degree in Data Science or related field, strong analytical skills', 'Health benefits, remote work options, casual dress code', CURRENT_TIMESTAMP),
  (2, 'Graphic Designer', 'Join our creative team as a Graphic Designer and bring ideas to life', 70000, 'graphic design, creative', 'CreativeWorks Inc.', '234 Design Blvd', 'Albany', 'NY', '499-321-9876', 'info@creativeworks.com', 'Bachelors degree in Graphic Design or related field, proficiency in Adobe Creative Suite', 'Flexible work hours, creative work environment, opportunities for growth', CURRENT_TIMESTAMP);
```

## Users & Privileges

Right now, we are using the `root` user to connect to our database without a password. Which is fine for development, but you never want to do this in production, so I will show you how to create a new user and set a password.

Go to the top menu and select `Server->Users and Privileges`. Click on the `Add Account` button. Give the user a name. I will call mine `workopia`. For the Authentication Type, select `Standard`. For the password, enter a password.

Click on the `Administrative Roles` tab. Check the `DBA` option. This will give the user full access to the database. Click on the `Schema Privileges` tab. Select the `workopia` schema and check the `ALL` option. This will give the user full access to the `workopia` schema. Click on the `Apply` button to save the user. You should see a success message. Click on the `Apply` button again and then click on the `Finish` button. Now you should be able to connect with that user from your application later on.

We have setup our database, schema, tables, columns and relationships. We have also added some data to our tables and created a new user.
