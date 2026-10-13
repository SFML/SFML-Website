"""Doxygen input filter for the anonymous union in sf::Event of SFML 1.6 and 2.x.

Since Doxygen 1.13, the members of an anonymous union end up on a separate page called
"[union].__unnamed0__" instead of the page of the enclosing class. The filter turns the union
into a member group, so its members are listed on the sf::Event page again. Doxygen requires
filters to keep the number of lines, so only the union and brace lines are replaced.

Usage (FILTER_PATTERNS): Event.hpp=python unnamed-union-filter.py
"""
import re
import sys

with open(sys.argv[1], encoding="utf-8", errors="surrogateescape") as file:
    lines = file.read().split("\n")

i = 0
while i + 1 < len(lines):
    union = re.match(r"^(\s*)union\s*$", lines[i])
    if union and lines[i + 1].strip() == "{":
        indent = union.group(1)
        eol = "\r" if lines[i].endswith("\r") else ""
        end = next(j for j in range(i + 2, len(lines)) if re.match(rf"^{indent}\}};\s*$", lines[j]))
        lines[i] = f"{indent}/** @name Event parameters (anonymous union, only the member of the current event type is valid) */{eol}"
        lines[i + 1] = f"{indent}//@{{{eol}"
        lines[end] = f"{indent}//@}}{eol}"
        i = end
    i += 1

sys.stdout.reconfigure(encoding="utf-8", errors="surrogateescape", newline="")
sys.stdout.write("\n".join(lines))
