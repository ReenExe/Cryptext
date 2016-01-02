@command
Feature:

    Scenario:
        Given I make file "fixtures/from/src.txt" with:
        """

        """
        And I make file "fixtures/key" with:
        """
        some-secret-key
        """
        And I make file "fixtures/cryptext.yml" with:
        """
        src: from
        key: key
        result: to
        recovery: from
        """

        When I run command "php app.php generate:key --path=fixtures"
        Then Command response is:
        """
        Key: some-secret-key
        Length: 15
        """

        When I run command "php app.php cryptext:main --path=fixtures"
        Then I have file "fixtures/to/src.txt" with:
        """

        """