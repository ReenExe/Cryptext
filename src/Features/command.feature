@command
Feature:

    Scenario:
        Given I have file "fixtures/from/src.txt" with:
        """

        """
        And I have file "fixtures/key" with:
        """
        some-secret-key
        """
        And I have file "fixtures/cryptext.yml" with:
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