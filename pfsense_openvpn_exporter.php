<?php

header("Content-Type: text/plain");
require_once("openvpn.inc");

$servers = openvpn_get_active_servers();

echo "# HELP openvpn_server_client_received_bytes_total Amount of data received over a connection on the VPN server, in bytes.\n";
echo "# TYPE openvpn_server_client_received_bytes_total counter\n";
foreach ($servers as $server) {
    foreach ($server['conns'] as $conn) {
        echo 'openvpn_server_client_received_bytes_total{common_name="'.$conn['common_name'].'",connection_time="'.$conn['connect_time_unix'].'",real_address="'.$conn['remote_host'].'",username="'.$conn['user_name'].'",virtual_address="'.$conn['virtual_addr'].'"} '. sprintf("%s", $conn['bytes_recv']) ."\n";
    }
}

echo "# HELP openvpn_server_client_sent_bytes_total Amount of data sent over a connection on the VPN server, in bytes.\n";
echo "# TYPE openvpn_server_client_sent_bytes_total counter\n";
foreach ($servers as $server) {
    foreach ($server['conns'] as $conn) {
        echo 'openvpn_server_client_sent_bytes_total{common_name="'.$conn['common_name'].'",connection_time="'.$conn['connect_time_unix'].'",real_address="'.$conn['remote_host'].'",username="'.$conn['user_name'].'",virtual_address="'.$conn['virtual_addr'].'"} '. sprintf("%s", $conn['bytes_sent']) ."\n";
    }
}

echo "# HELP openvpn_server_connected_clients Number Of Connected Clients\n";
echo "# TYPE openvpn_server_connected_clients gauge\n";
echo "openvpn_server_connected_clients{} ". count($servers[0]['conns']) ."\n";

echo "# HELP openvpn_up Whether scraping OpenVPN's metrics was successful.\n";
echo "# TYPE openvpn_up gauge\n";
echo "openvpn_up{} 1\n";