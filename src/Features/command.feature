@command
Feature:

    Scenario: Generate Key
        Given I make file "fixtures/cryptext.yml" with:
        """
        src: from
        key: key
        result: to
        recovery: from
        """
        And I make file "fixtures/key" with:
        """
        some-secret-key
        """
        When I run command "php app.php generate:key --path=fixtures"
        Then Command response is:
        """
        Key: some-secret-key
        Length: 15
        """

    Scenario Outline:
        Given I make file "fixtures/from/src.txt" with:
        """
        <source>
        """
        And I make file "fixtures/key" with:
        """
        <key>
        """
        And I make file "fixtures/cryptext.yml" with:
        """
        src: from
        key: key
        result: to
        recovery: from
        """

        When I run command "php app.php cryptext:main --path=fixtures"
        Then I have file "fixtures/to/src.txt" with:
        """
        <expected>
        """
    Examples:
        | source | expected | key |
        |        |          |     |
        | 111    | PPP      | a   |
        | 111    | PPP      | aa  |
        | 111    | PSP      | ab  |