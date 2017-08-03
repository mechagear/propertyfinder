# propertyfinder

**How to launch demo (from the project directory):**
1. Run `php demo.php`

**How to launch tests:**
1. Download phpunit.phar
2. Run: `php /PATH/TO/phpunit.phar --configuration /PATH/TO/propertyfinder/phpunit.xml`

**Assumptions:**
1. To prevent multiple solutions of the problem, 
suppose that there can not be two departures from the same place in the list of 
boarding cards, and the first departure point and the last arrival place can not 
present in other boarding cards maps (otherwise, the task has no practical meaning).