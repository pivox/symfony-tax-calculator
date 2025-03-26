import 'bootstrap/dist/css/bootstrap.min.css'

import 'bootstrap'

// Stimulus
import { Application } from '@hotwired/stimulus'
import TaxController from './controllers/tax_controller'

const application = Application.start()
application.register('tax', TaxController)
