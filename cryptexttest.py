import unittest

from unittest_data_provider import data_provider
from cryptext import Cryptext

class TicTacTest(unittest.TestCase):
    data = lambda: (
        ('value', 15),
        ('next', 64)
    )

    @data_provider(data)
    def testTravis(self, text, key):
        crypt = Cryptext.execute(text, key)

        self.assertNotEqual(text, crypt)

        self.assertEqual(text, Cryptext.execute(crypt, key))

unittest.main()