<?php
/**
 * 
 */
class RestAPI extends Controller {
	
	public function __construct(){
		parent::__construct();
		$this->checkAuthenticationType();
	}
	/**
	 * Use this function send api errors. send the error in json type format
	 * @param status code
	 * @param message to respond
	 * 
	 */
	protected static function sendAPIerror($statusCode, $message) {
            if ($statusCode !== NULL) {
                switch ($statusCode) {
                    case 100: $text = 'Continue'; break;
                    case 101: $text = 'Switching Protocols'; break;
                    case 200: $text = 'OK'; break;
                    case 201: $text = 'Created'; break;
                    case 202: $text = 'Accepted'; break;
                    case 203: $text = 'Non-Authoritative Information'; break;
                    case 204: $text = 'No Content'; break;
                    case 205: $text = 'Reset Content'; break;
                    case 206: $text = 'Partial Content'; break;
                    case 300: $text = 'Multiple Choices'; break;
                    case 301: $text = 'Moved Permanently'; break;
                    case 302: $text = 'Moved Temporarily'; break;
                    case 303: $text = 'See Other'; break;
                    case 304: $text = 'Not Modified'; break;
                    case 305: $text = 'Use Proxy'; break;
                    case 400: $text = 'Bad Request'; break;
                    case 401: $text = 'Unauthorized'; break;
                    case 402: $text = 'Payment Required'; break;
                    case 403: $text = 'Forbidden'; break;
                    case 404: $text = 'Not Found'; break;
                    case 405: $text = 'Method Not Allowed'; break;
                    case 406: $text = 'Not Acceptable'; break;
                    case 407: $text = 'Proxy Authentication Required'; break;
                    case 408: $text = 'Request Time-out'; break;
                    case 409: $text = 'Conflict'; break;
                    case 410: $text = 'Gone'; break;
                    case 411: $text = 'Length Required'; break;
                    case 412: $text = 'Precondition Failed'; break;
                    case 413: $text = 'Request Entity Too Large'; break;
                    case 414: $text = 'Request-URI Too Large'; break;
                    case 415: $text = 'Unsupported Media Type'; break;
                    case 500: $text = 'Internal Server Error'; break;
                    case 501: $text = 'Not Implemented'; break;
                    case 502: $text = 'Bad Gateway'; break;
                    case 503: $text = 'Service Unavailable'; break;
                    case 504: $text = 'Gateway Time-out'; break;
                    case 505: $text = 'HTTP Version not supported'; break;
                    default:
						throw new MegatronException("Unknown http status code {$statusCode}" , 1);
                    break;
              }
          } else {
          	throw new MegatronException("Unknown http status code {$statusCode}" , 1);
          }
		http_response_code($statusCode);
		echo json_encode(array( 'Status Code' => $statusCode, 'Status Text' => $text, 'Message' => $message));
		exit (1);
	}
	
	/**
	 * Public function that gathers the spot for a given lng and lat. Both must be set in the post
	 */
	public function getFreeSpots() {
		$jsonResponse = array();
		if ( isset($_POST['lat']) && isset($_POST['lng']) ) {
			$result = $this->model->getFreeSpotsFromDB($_POST['lat'], $_POST['lng']);
			foreach ($result as $row) {
				$row['level'] = Session::getUserLevel();
				$jsonResponse[$row['fs_metaInfo']][] = $row;
			}
			echo json_encode($jsonResponse);
		}else {
			self::sendAPIerror(406, 'Incorrect parameters. You must supply latitude and longtitude from which you want to take the spots');
		}
	}
	/**
	 * Public function that let us insert data points 
	 */
	public function insertDataPoint() {
		//not used. To be completed.
		// $name = 'Free spot', $metaInfo, $lat, $lng, $comments = ''
		if ($this->model->validatePoint() ) {
			$this->model-> insertPoint();
			echo json_encode("1");
		}else {
			self::sendAPIerror(403, 'Error Processing Request');
		}
	}
	
	/**
	 * Check authentication type. Either via token or authenticated user.
	 */
	
	private function checkAuthenticationType() {
		if ( !Session::logged() ) {
	 		if (!isset($_GET['token']) || !$this->model->verifyTokenAuthentication($_GET['token']) ) {
	 			self::sendAPIerror(401, "Megatron error: 'Invalid token or user is not logged in'");
				exit;
			}	
	 	}
	}
	
	/**
	 * Gets some objects for the datatable. FOR A DEMO
	 */
	 public function getDataTableSpots (){
	 	$json = '{"data": [
					    {
					      "Name": "Tiger Nixon",
					      "Password": "free",
					      "Latitude": "42.160639",
					      "Longtitude": "24.753112"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					    {
					      "Name": "Dummy",
					      "Password": "free",
					      "Latitude": "45.165439",
					      "Longtitude": "22.745612"
					    },
					     {
					      "Name": "Tiger Nixon",
					      "Password": "free",
					      "Latitude": "42.160639",
					      "Longtitude": "24.753112"
					    }
					  ]
					}';
		echo $json;
	 }
}
 
?>