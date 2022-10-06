import _ from 'lodash'
import axios from 'axios'
import * as bootstrap from 'bootstrap'

import jQuery from 'jquery'
import DataTable from 'datatables.net-bs5'
DataTable(window, jQuery)

window.$ = jQuery
window._ = _
window.bootstrap = bootstrap
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const csrf_token = document.head.querySelector('meta[name="csrf-token"]')
if (csrf_token) {
    window.csrf_token = csrf_token.content
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token
} else console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')