param name string
param location string
param tags object

var prefix = '${name}-${uniqueString(resourceGroup().id)}'

// --- APP SERVICE ---
resource appServicePlan 'Microsoft.Web/serverfarms@2022-03-01' = {
  name: '${prefix}-plan'
  location: location
  tags: tags
  sku: {
    name: 'B1' // Basic Tier for Custom Domains
    tier: 'Basic'
  }
  kind: 'linux'
  properties: {
    reserved: true
  }
}

resource webApp 'Microsoft.Web/sites@2022-03-01' = {
  name: '${prefix}-web'
  location: location
  tags: tags
  kind: 'app,linux'
  properties: {
    serverFarmId: appServicePlan.id
    siteConfig: {
      linuxFxVersion: 'PHP|8.2'
      alwaysOn: false
      appSettings: [
        {
          name: 'WORDPRESS_DB_HOST'
          value: mysqlServer.properties.fullyQualifiedDomainName
        }
        {
          name: 'WORDPRESS_DB_NAME'
          value: 'wordpress'
        }
        {
          name: 'WORDPRESS_DB_USER'
          value: 'wpadmin'
        }
        {
          name: 'WORDPRESS_DB_PASSWORD'
          value: 'P@ssw0rd123!' // Placeholder, update to secure secret
        }
      ]
    }
  }
}

// --- MYSQL FLEXIBLE SERVER ---
resource mysqlServer 'Microsoft.DBforMySQL/flexibleServers@2021-05-01' = {
  name: '${prefix}-mysql'
  location: location
  tags: tags
  sku: {
    name: 'Standard_B1ms'
    tier: 'Burstable'
  }
  properties: {
    administratorLogin: 'wpadmin'
    administratorLoginPassword: 'P@ssw0rd123!' // Placeholder, update to secure secret
    version: '8.0.21'
    availabilityZone: '1'
    storage: {
      storageSizeGB: 20
      iops: 360
      autoGrow: 'Enabled'
    }
    backup: {
      backupRetentionDays: 7
      geoRedundantBackup: 'Disabled'
    }
  }
}

resource mysqlDb 'Microsoft.DBforMySQL/flexibleServers/databases@2021-05-01' = {
  parent: mysqlServer
  name: 'wordpress'
  properties: {
    charset: 'utf8mb4'
    collation: 'utf8mb4_unicode_ci'
  }
}

// Allow App Service access
resource mysqlFirewallAzure 'Microsoft.DBforMySQL/flexibleServers/firewallRules@2021-05-01' = {
  parent: mysqlServer
  name: 'AllowAzureServices'
  properties: {
    startIpAddress: '0.0.0.0'
    endIpAddress: '0.0.0.0'
  }
}

output WEB_APP_NAME string = webApp.name
output MYSQL_HOST string = mysqlServer.properties.fullyQualifiedDomainName
