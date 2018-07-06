Feature: Testing
    In order to teach Behat
    As a teacher
    I want to demostrate how to install and create features

    Scenario: Encuestas
        Given I am  on the encuesta
        Then I should see "Ingreso Encuesta"

    Scenario: Home Page
        Given I am  on the homepage
        Then I should see "Noticias"

    Scenario: Dashboard is locked for guests
        When I go to "home"
        Then the url should match "login"
        And I can do something with Laravel