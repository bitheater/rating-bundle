RatingBundle
============

This bundle allows you to include ratings for any kind of element in your web page.

*UNDER CONSTRUCTION*, so please don't use this bundle yet :)

Installation
------------

* Add the dependency to your `composer.json`: `composer require bitheater/rating-bundle`
* Bootstrap the bundle in your `AppKernel.php` file: `new Bitheater\RatingBundle\BitheaterRatingBundle()`
* Configure the bundle (for now we just support MySQL, but it should be trivial to support other datastores!):

```yml
bitheater_rating:
    driver: orm
    model_class: MyBundle\Entity\Vote
```

Create the vote class, extending the base vote one:

```php
use Bitheater\RatingBundle\Model\Vote as RatingVote;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bitheater\RatingBundle\Repository\Doctrine\ORMRepository")
 * @ORM\Table(name="vote")
 */
class Vote extends RatingVote
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }
}
```

* Done! Just use the service now:

`$ratingManager = $this->get('bitheater_rating.manager');`

Enjoy!
