# PfSense OpenVPN Exporter

Simple PHP endpoint to obtain OpenVPN service metrics on a pfSense Firewall for use with Prometheus.

## How to deploy PHP Endpoint on pfSense server

1. Copy `pfsense_openvpn_exporter.php` file to the root directory for NGINX (usually at `/usr/local/www`). You can do this using SSH/SCP, for example:
    ```sh
    scp pfsense_openvpn_exporter.php root@<pfsense_ip_server>:/usr/local/www/
    ```

2. Now, it's possible to get OpenVPN metrics by accessing:
    ```
    http://<pfsense_ip_server>/pfsense_openvpn_exporter.php
    ```

## Example of Use

Once deployed, you can configure Prometheus to scrape metrics from the PHP endpoint. Add the following job to your Prometheus configuration:
```yaml
scrape_configs:
  - job_name: 'pfsense_openvpn'
    static_configs:
      - targets: ['<pfsense_ip_server>']
        labels:
          instance: 'pfsense_openvpn'
```
Replace <pfsense_ip_server> with the IP address of your pfSense server.

## Proposed Metrics

The metrics provided by this exporter are based on those proposed in the [kumina/openvpn_exporter](https://github.com/kumina/openvpn_exporter) repository. This ensures compatibility and ease of integration with existing monitoring setups that use these metrics.

## Troubleshooting

If you encounter issues, ensure that:

    The pfsense_openvpn_exporter.php file has been correctly copied to the /usr/local/www directory.
    NGINX is running and serving files from the /usr/local/www directory.

## Contributing

If you would like to contribute, please fork the repository and submit a pull request. We welcome all improvements and suggestions!

## Acknowledgments

    Thanks to the developers of pfSense for providing an excellent firewall solution.
    Thanks to the Prometheus team for their great monitoring tools.
    Thanks to the [kumina/openvpn_exporter](https://github.com/kumina/openvpn_exporter) repository for the inspiration and metrics design.
