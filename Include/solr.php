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

function solrSearch ($test) {
	$client = solrClient();
	$query = new SolrQuery();
	$query->setQuery($test);
	$query->addField('id')->addField('title')->addField('barcode')->addField('author')->addField('format');
	$queryResponse = $client->query($query);
	$response = $queryResponse->getResponse();
	$results = ( $response->response->docs );
	return $results;
}

function solrSearchFacets ($test) {
	$client = solrClient();
	$query = new SolrQuery();
	$query->setQuery($test);
	$query->addField('id')->addField('title')->addField('barcode')->addField('author')->addField('format');
	$query->setRows(25);
	$query->setFacet(true);
	$query->addFacetField('author')->addFacetField('format');
	$queryResponse = $client->query($query);
	$response = $queryResponse->getResponse();
	$results = ( $response->response->docs );
	return $results;
}

?>
