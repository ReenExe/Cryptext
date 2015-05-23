class Cryptext(object):

    @staticmethod
    def execute(text, key):
        hash = ''

        for letter in text:
            hash += chr(ord(letter) ^ key)

        return hash