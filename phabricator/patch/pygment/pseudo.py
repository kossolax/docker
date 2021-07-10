# -*- coding: utf-8 -*-
"""
pygments.lexers.pseudo
~~~~~~~~~~~~~~~~~~~~~~

Lexers for the PseudoCode language.

:copyright: Copyright 2006-2019 by the Pygments team, see AUTHORS.
:license: BSD, see LICENSE for details.
"""
from pygments.lexer import RegexLexer, bygroups, words
from pygments.token import Text, Comment, Operator, Keyword, Name, String, Number, Punctuation

__all__ = ['PseudoLexer']

class PseudoLexer(RegexLexer):
        name = 'Pseudo'
        aliases = ['pseudo', 'pseudocode']
        filenames = ['*.pc']

        tokens = {
        'root': [
                (words(('DÉBUT', 'FIN', 'PROCÉDURE', 'PROCEDURE', 'FONCTION', 'RETOURNER'), suffix=r'\b'), Name.Builtin),
                (words(('VARIABLE', 'CONSTANTE', 'LIRE', 'ECRIRE', 'ÉCRIRE', 'TABLEAU')), Keyword),

                (words(('RÉEL', 'ENTIER', 'BOOL', 'BOOLÉEN', 'STRUCTURE')), Keyword.Type),
                (words(('VRAI', 'FAUX')), Keyword.Constant),

                (words(('SI', 'SINON', 'FIN', 'SELON', 'CAS', 'RÉPETER', 'RÉPÉTER', 'REPETER', 'TANT QUE', 'POUR', 'DE', 'À', 'A')), Name.Builtin),

                (r'\n', Text),
                (r'\s+', Text),
                (r'L?"', String, 'string'),

                (r'[~!%^&*+=|?:<>/-]', Operator),
                (u'\u2190', Operator),

                (r"L?'(\\.|\\[0-7]{1,3}|\\x[a-fA-F0-9]{1,2}|[^\\\'\n])'", String.Char),
                (r'(\d+\.\d*|\.\d+|\d+)[eE][+-]?\d+[LlUu]*', Number.Float),
                (r'(\d+\.\d*|\.\d+|\d+[fF])[fF]?', Number.Float),
                (r'0x[0-9a-fA-F]+[LlUu]*', Number.Hex),
                (r'0[0-7]+[LlUu]*', Number.Oct),
                (r'\d+[LlUu]*', Number.Integer),

                (r'[()\[\],.;]', Punctuation),
                (r'[a-zA-Z_]\w*', Name),

        ],
        'string': [
                (r'"', String, '#pop'),
                (r'\\([\\abfnrtv"\']|x[a-fA-F0-9]{2,4}|[0-7]{1,3})', String.Escape),
                (r'[^\\"\n]+', String),# all other characters
                (r'\\\n', String),
                (r'\\', String),
        ],
}
