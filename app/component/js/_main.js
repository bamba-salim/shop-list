function _log_redirect() {
  if (!_.isNull(localStorage.getItem('u_t'))) {
    window.location.href = './'
  }
}

function _unlog_redirect() {
  if (_.isNull(localStorage.getItem('u_t'))) {
    window.location.href = './login'
  }
}
