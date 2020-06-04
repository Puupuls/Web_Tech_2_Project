Description of Practical Assignment “Finance tracker”
===

### Team of developers

Only one student will be developing this system:

-   Pauls Purviņš, pp19026 (design, UI design, business logic design, all programming of models, views and controllers, database design)

### Development environment2

It is planned to develop the system in PHP 7.4.3 environment using Laravel 7.6.2 library. It is planned to use MySQL 8.0 database system for data storage. The code will be stored in the GitHub system.

### Main Functionality

It is planed to develop a system, where user s can keep track of their income and expenses.

It will be possible for users to register and keep track of their money as well as to add someone else, for example, family member, to his/her finance tracker. User will be able to add and modify different income end expense sources and add descriptions to each expense or income unit.

A search / filter for past expenses will be implemented too

### Data registry

Main data in the system is: User, expense tracking instance, expense category, income source and most importantly – transaction.

![Planed database layout](./DB_GRAPH.png 'Planed database layout')

System consists of expense trackers – logbook type instance that a user can create. User can add personalized categories for money income and expenses, as well as add other user as participant in his tracker. If tracker owner allows so, participants can also add expenses/income and they are added to logbook. Each expense/income is tied to user that created it. To expense user can add amount, description and image if they want to.

### MVC

The system will be implemented following an MVC paradigm. The system will be distributed into the following components:

Models:

-   User
-   Tracker
-   Income\_source
-   Expense\_category
-   Transactions
-   Participant

Views:

-   register (using Laravel inbuilt register, with own style)
-   login (using Laravel inbuilt login, with own style)
-   edit profile
-   add / edit tracker
-   list trackers (show stats for each for this month, previous month)
-   add / edit income source
-   add / edit expense category
-   add / edit expense
-   list expenses
-   Admin – see generic statistics about system
-   Home page

Controllers:

-   UserController with methods for opening (show) and editing(update) user profile as well as stats generator for admin view (admin\_stats)
-   TrackerController with methods for seeing all (index)/ creating (store) / editing(update) / deleting (destroy) trackers
-   ParticipantController with methods for seeing all inside tracker (index) / viewing specified (show) / creating (store) / editing(update) / deleting (destroy) participants
-   IncomeSourceController with methods for seeing all inside tracker (index) / viewing specified (show) / creating (store) / editing(update) / deleting (destroy) / getting as array (list) income sources
-   ExpenseCategoryController with methods for seeing all inside tracker(index) / viewing specified (show) / creating (store) / editing(update) / deleting (destroy) / getting as array (list) expense categories
-   TransactionController with methods for seeing all inside tracker(index) / viewing specified (show) / creating (store) / editing(update) / deleting (destroy) / getting as array (list) transactions
-   Laravel standard RegisterController and LoginController

### User Roles

The system supports multiple user roles – guest (page visitor who has not logged in), user and admin (user with more permissions). Each of them can do different things.

Guest:

-   See home page
-   Login
-   Register

User:

-   add / modify / remove own trackers
-   add / modify / remove participants in own trackers
-   add / modify / remove Income sources in own trackers / trackers where has permissions from owner
-   add / modify / remove Expense categories in own trackers / trackers where has permissions from owner
-   add / modify / remove Transactions in own trackers / trackers where has permissions from owner

Admin:

-   Everything that user can do
-   See site-wide statistics

### User Authentication:

It is possible to register and login using sites login systems, that are based on Laravel standard RegisterController and LoginController

### Security:

RegisterController and LoginController uses bcrypt password hashing algorithm, which is one of the best algorithms for password hashing and makes sure that even in data breach situation users passwords will be incredibly hard to crack.

Every form uses csrf (Cross-site request forgery) token which prevents malicious 3<sup>rd</sup> party sites from exploiting user and submitting to our system data, that he/she didn’t want to, for example delete profile / tracker / some transactions. This token is automatically checked by CSRFProtectionMiddleware for each POST request to be sure that data coming from user is indeed from our site, not from some other site that has form, that targets our site.

Site uses SSL certificate so users can be sure that their data is secure.

### System interface

The image shows main interface where user can look at his transactions and search for specific one
![Planed UI Layout](./UI_GRAPH_1.png 'Planed UI Layout')
In this image main tracker select screen is shown, where user can manage tracker settings, and see statistics about their finances.
![Planed UI Layout](./UI_GRAPH_2.png 'Planed UI Layout')
