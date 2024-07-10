name: Update API 
on:
  push:
    branches:
      - main
  workflow_dispatch:
  schedule:
    - cron: "30 3 * * *"
jobs:
  update-api:
    if: ${{ github.repository == 'saimedhi/opensearch-php' }}
    runs-on: ubuntu-latest
    permissions:
      contents: write
      pull-requests: write
    steps:
      - uses: actions/checkout@v4
        with:
          submodules: recursive
          fetch-depth: 0
      - name: Config git to rebase
        run: git config --global pull.rebase true
      - name: Setup PHP 8.3
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3.6' 
          tools: composer:v2.7.2
      - name: Install dependencies
        run: composer install
      - name: Generate API
        run: php util/GenerateEndpoints.php
      - name: Format
        run: composer run php-cs 
      - name: Get current date
        id: date
        run: echo "::set-output name=date::$(date +'%Y-%m-%d')"
      - name: Create pull request
        id: cpr
        uses: peter-evans/create-pull-request@v5
        with:
          commit-message: Updated opensearch-php to reflect the latest OpenSearch API spec (${{ steps.date.outputs.date }})
          title: Updated opensearch-php to reflect the latest OpenSearch API spec
          body: |
            Updated [opensearch-php](https://github.com/opensearch-project/opensearch-php) to reflect the latest [OpenSearch API spec](https://github.com/opensearch-project/opensearch-api-specification/releases/download/main-latest/opensearch-openapi.yaml)
            Date: ${{ steps.date.outputs.date }}
          branch: automated-api-update
          base: main
          signoff: true
          labels: |
              autocut

              
