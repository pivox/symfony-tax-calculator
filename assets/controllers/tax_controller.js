import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['salary', 'results']


    async submit(event) {
        event.preventDefault()

        const salary = parseFloat(this.salaryTarget.value)

        const response = await fetch('/api/tax/'+salary, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        })

        const data = await response.json()

        this.resultsTarget.innerHTML = `
      <div class="mt-4">
        <h5>Results for £ ${salary}</h5>
        <ul class="list-group">
          <li class="list-group-item">Gross Annual Salary: £ ${data.gross_annual}</li>
          <li class="list-group-item">Annual Tax Paid: £ ${data.tax_annual}</li>
          <li class="list-group-item">Net Annual Salary: £ ${data.net_annual}</li>
          <li class="list-group-item">Gross Monthly Salary: £ ${data.gross_monthly}</li>
          <li class="list-group-item">Net Monthly Salary: £ ${data.net_monthly}</li>
          <li class="list-group-item">Monthly Tax Paid: £ ${data.monthly_tax}</li>
          <li class="list-group-item">Tax Rate: ${data.tax_ratio}</li>
        </ul>
      </div>
    `
    }
}
