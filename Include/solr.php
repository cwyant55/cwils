<?php

define('SOLR_SERVER_TIMEOUT', 10);

function solrClient() {
	$options = array (
    'host' => "localhost",
    'port' => 8983, //port is required
    'path' => '/solr/cwils'
);	
$client = new SolrClient($options);
return $client;
}

function solrTest ($test) {
	$client = solrClient();
	$query = new SolrQuery();
	$query->setQuery($test);
	$query->addField('id')->addField('title');
	$queryResponse = $client->query($query);
	$response = $queryResponse->getResponse();
	$results = ( $response->response->docs );
	return $results;
}

?>
