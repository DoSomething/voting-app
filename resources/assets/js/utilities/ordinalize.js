/**
 * Return the given number with its ordinal suffix.
 * @see http://stackoverflow.com/a/13627586
 *
 * @param {number} number - Integer to append ordinal suffix to
 * @returns {string} Formatted number
 */
function ordinalize(number) {
  const j = number % 10;
  const k = number % 100;

  if (j === 1 && k !== 11) {
    return `${number}st`;
  }

  if (j === 2 && k !== 12) {
    return `${number}nd`;
  }

  if (j === 3 && k !== 13) {
    return `${number}rd`;
  }

  return `${number}th`;
}

export default ordinalize;
