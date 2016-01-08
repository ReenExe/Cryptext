@command
Feature:

    Background:
        Given I clear directory "fixtures"
        And I make file "fixtures/cryptext.yml" with:
        """
        src: from
        key: key
        result: to
        recovery: from
        """

    Scenario: Generate Key
        Given I make file "fixtures/key" with:
        """
        some-secret-key
        """
        When I run command "php app.php generate:key --path=fixtures"
        Then Command response is:
        """
        Key: some-secret-key
        Length: 15
        """

    Scenario Outline: Generate algorithm key
        Given I make file "fixtures/key" with:
        """
        //

        <algorithm>
        """
        When I run command "php app.php generate:key --path=fixtures"
        Then Command response is:
        """
        Key: <expected>
        Length: <length>
        """
    Examples:
        | algorithm                         | expected | length |
        | return 1;                         | 1        | 1      |
        | return 'secret';                  | secret   | 6      |
        | return join('', range('a', 'c')); | abc      | 3      |

    Scenario Outline:
        Given I make file "fixtures/from/src.txt" with:
        """
        <source>
        """
        And I make file "fixtures/key" with:
        """
        <key>
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

    Scenario Outline: children
        Given I make file "fixtures/from/<path>" with:
        """
        <source>
        """
        And I make file "fixtures/key" with:
        """
        <key>
        """
        When I run command "php app.php cryptext:main --path=fixtures"
        Then I have file "fixtures/to/<path>" with:
        """
        <expected>
        """
    Examples:
        | path               | source | expected | key |
        | index.html         | 111    | PPP      | a   |
        | assets/js/index.js | 111    | PPP      | a   |