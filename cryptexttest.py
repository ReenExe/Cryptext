import unittest

from cryptext import Cryptext

class TicTacTest(unittest.TestCase):

    def testTravis(self):
        self.assertTrue(Cryptext.execute())

unittest.main()