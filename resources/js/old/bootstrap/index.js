import $ from 'jquery'
import Alert from './alert'
import Button from './button'
import Carousel from './carousel'
import Collapse from './collapse'
import Dropdown from './dropdown'
import Modal from './modal'
import Popover from './popover'
import Scrollspy from './scrollspy'
import Tab from './tab'
import Toast from './toast'
import Tooltip from './tooltip'
import Util from './util'
import 'bootstrap-select'

import './app/dynamicSidebarServerStatus'
import './app/dynamicSidebarTeamspeakStatus'
import './app/markdownEditorBootstraper'

import './app/servicePurchaseFormInputHandler'
import './app/serverActiveStatusButtonHandler'
import './app/serverConnectionMethodSwitch'
import './app/serverAnnouncementStatusMessageUpdater'
import './app/serverDeleteConfirmationModal'
import './app/entityActiveFilterSelectHandler'
import './app/numberBruttoCalculator'
import './app/serviceCommandsDynamicInput'
import './app/checkboxSectionCollapse'
import './app/voucherMultiusageSelector'
import './app/pageContentTypeSwitch'

import './vmcshop'

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.3.1): index.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */

$('select').selectpicker({
  iconBase: 'fas',
  tickIcon: 'fa-check',
  noneSelectedText: 'Nic nie wybrano',
  noneResultsText: 'Brak wyników dla frazy: {0}',
  showTick: true,
  size: 10,
  style: '',
  styleBase: 'form-control',
});

(() => {
  if (typeof $ === 'undefined') {
    throw new TypeError('Bootstrap\'s JavaScript requires jQuery. jQuery must be included before Bootstrap\'s JavaScript.')
  }

  const version = $.fn.jquery.split(' ')[0].split('.')
  const minMajor = 1
  const ltMajor = 2
  const minMinor = 9
  const minPatch = 1
  const maxMajor = 4

  if (version[0] < ltMajor && version[1] < minMinor || version[0] === minMajor && version[1] === minMinor && version[2] < minPatch || version[0] >= maxMajor) {
    throw new Error('Bootstrap\'s JavaScript requires at least jQuery v1.9.1 but less than v4.0.0')
  }
})()

export {
  Util,
  Alert,
  Button,
  Carousel,
  Collapse,
  Dropdown,
  Modal,
  Popover,
  Scrollspy,
  Tab,
  Toast,
  Tooltip,
  $,
}
