<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    public function iAmOnTheHomepage()
    {
        throw new PendingException();
    }

    /**
     * @Then I can do something with Laravel
     */
    public function iCanDoSomethingWithLaravel()
    {
        PHPUnit::assertEquals('.env.behat', app()->environmentFile() );
    }

     /**
      * @Given I am  on the encuesta
      */
     public function iAmOnTheEncuesta()
     {
         throw new PendingException();
     }

    /**
     * @Given I am  on the homepage
     */
    public function iAmOnTheHomepage2()
    {
        throw new PendingException();
    }




}
