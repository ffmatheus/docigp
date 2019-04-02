window._ = require('lodash')

window.Popper = require('popper.js').default

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery')

    require('bootstrap')
} catch (e) {}

/**
 * Moment.js
 */
window.moment = require('moment')
moment.locale('pt-br')

/**
 * sha256
 */
let sha256 = require('sha256')
window.sha256 = sha256

/**
 * cheerio
 */
let cheerio = require('cheerio')
window.cheerio = cheerio
