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
present in other boarding cards maps (otherwise, the task has no practical meaning 
and can't be done in ~2 hours).
2. I assumed that the generated list from the task in text form is a separate feature, 
because the text output does not correspond to the requirement of compatibility of 
input and output data.

**Notes**
1. Most classes turned out to be quite primitive, since the parameters of the 
boarding card, such as the gate number, seat number, information about the baggage, 
refer exclusively to the card, and not to the place of departure and arrival or the 
type of transport.
2. To solve this particular problem, it was not necessary to create a separate class 
for each type of transport, it would be sufficient to use a map type => name and in 
the __toString method use this map to produce correct name for template.
However, if we assume that each transport can have unique fields, then the segregation 
of each type of entity in its class is correct.
(In addition, due to this, it was possible to demonstrate the "Factory method" pattern)