<?php

// require 'vendor/autoload.php';
require_once ABSPATH . 'wp-content/plugins/mailjet-for-wordpress/vendor/autoload.php';

use \Mailjet\Resources;

class JFW_Mailjet
{
	private $api_key;
	private $api_secret_key;

	private $sender = "fondation antoine de galbert";
	private $senderEmail = "info@fondationantoinedegalbert.org";





	public function __construct()
	{
		if( get_option('mailjet_apikey') != '' ){
			$this->api_key = get_option('mailjet_apikey');
		}
		if( get_option('mailjet_apisecret') != '' ){
			$this->api_secret_key = get_option('mailjet_apisecret');
		}
	}





	public function getContactLists( $newsletter_id ){

		$mj = new Mailjet\Client( $this->api_key, $this->api_secret_key );
		
		$filters = ['Limit' => '100'];
		
		$response = $mj->get(Resources::$Contactslist, ['filters' => $filters]);

		if( $response->success() )
		{

			$str = '<strong>Liste de contacts</strong><br/>';
			$str .= '<select class="jfw-mailjet-list-select" id="jfw-mailjet-select-main" style="width:100%;margin:3px 0 6px 0;">';
			$str .= '<option value="none">Aucune</option>';
			foreach( $response->getData() as $rep_item )
			{
				if( get_option( 'fadg-list-' . $newsletter_id . '-contact', 'none' ) == $rep_item['ID'] ){
					$str .= '<option value="' . $rep_item['ID'] . '" selected="selected">' . $rep_item['Name'] . ' (' . $rep_item['SubscriberCount'] . ')</option>';
				}else{
					$str .= '<option value="' . $rep_item['ID'] . '">' . $rep_item['Name'] . ' (' . $rep_item['SubscriberCount'] . ')</option>';
				}
			}
			$str .= '</select>';

			return $str;

		}else{

			return 'error';

		}

	}





/*
	public function getSegmentLists( $newsletter_id ){

		$mj = new \Mailjet\Client( $this->api_key, $this->api_secret_key ); //
		
		$response = $mj->get(Resources::$Contactfilter);

		if( $response->success() )
		{

			$str = '<strong>Segments</strong><br/>';
			$str .= '<select class="jfw-mailjet-segment-select" id="jfw-mailjet-select-segment" style="width:100%;margin:3px 0 6px 0;">';
			$str .= '<option value="none">Aucune</option>';
			foreach( $response->getData() as $rep_item )
			{
				if( get_option( 'fadg-list-' . $newsletter_id . '-segment', 'none' ) == $rep_item['ID'] ){
					$str .= '<option value="' . $rep_item['ID'] . '" selected="selected">' . $rep_item['Name'] . '</option>';
				}else{
					$str .= '<option value="' . $rep_item['ID'] . '">' . $rep_item['Name'] . '</option>';
				}
			}
			$str .= '</select>';

			return $str;

		}else{

			return 'error';

		}

	}
*/





/*
	public function sendTest( $newsletter_id, $newsletter_str ){

		$mj = new \Mailjet\Client( $this->api_key, $this->api_secret_key );

		$mail_subject = get_field( 'fadg-newsletter-subject', $newsletter_id );

		$message_html = $newsletter_str;
		$mail_test_version = get_field( 'fadg-newsletter-alt-text', $newsletter_id );

		$test_rep = [];
		$array_rep = get_field( 'fadg-test-mail', 'options' );
		
		foreach( $array_rep as $array_rep_item )
		{
			
			$to_push = [ 'Email' => $array_rep_item['mail'] ];
			array_push( $test_rep, $to_push );
		}

		$body = [
		    'FromEmail' => $this->senderEmail,
		    'FromName' => $this->sender,
		    'Subject' => '[TEST] ' . $mail_subject,
			'Text-part' => $mail_text_version,
		    'Html-part' => $message_html,
		    'Recipients' => $test_rep,
		];
		
		$response = $mj->post( Resources::$Email, ['body' => $body, 'method' => 'POST'] );
		
		if( $response->success() ){
			return 'success';
		}else{
			return 'error - ' . $response->getData();
		}

	}
*/










	public function sendNews( $newsletter_id, $newsletter_str ){

		$mj = new \Mailjet\Client( $this->api_key, $this->api_secret_key );

		$mail_subject = get_field( 'fadg-newsletter-subject', $newsletter_id );
		$mail_text_version = get_field( 'fadg-newsletter-text-content', $newsletter_id );

		$message_html = $newsletter_str;
		
		if( get_field( 'fadg-newsletter-type', $newsletter_id ) == 'collection' ){

			$this->sender = 'collection antoine de galbert';
			$this->senderEmail = 'info@collectionantoinedegalbert.org';

		}

/*
		if( get_option( 'fadg-list-' . $newsletter_id . '-segment', 'none' ) == 'none' )
		{
*/
			$body_prepare = [
				'Locale' => "fr_FR",
				'Sender' => $this->sender,
				'SenderEmail' => $this->senderEmail,
				'SenderName' => $this->sender,
				'Subject' => $mail_subject,
				'ContactsListID' => get_option( 'fadg-list-' . $newsletter_id . '-contact' ),
				'Title' => get_the_title( $newsletter_id ),
			];

/*
		}else{

			$body_prepare = [
				'Locale' => "fr_FR",
				'Sender' => $this->sender,
				'SenderEmail' => $this->senderEmail,
				'SenderName' => $this->sender,
				'Subject' => $mail_subject,
				'ContactsListID' => get_option( 'fadg-list-' . $newsletter_id . '-contact' ),
				'SegmentationID' => get_option( 'fadg-list-' . $newsletter_id . '-segment' ),
				'Title' => get_the_title( $newsletter_id ),
			];

		}
*/



		$response = $mj->post(Resources::$Newsletter, [ 'body' => $body_prepare ]);

		if( $response->success() )
		{
			$news_id = $response->getData()[0]['ID'];
			$body_content = [
				'Html-part' => $message_html,
				'Text-part' => $mail_text_version,
			];

			$response_content= $mj->put(Resources::$NewsletterDetailcontent, [ 'id' => $news_id, 'body' => $body_content ]);

			if( $response_content->success() )
			{
				$response_n = $mj->post( Resources::$NewsletterSend,  [ 'id' => $news_id ] );

				if( $response_n->success() )
				{

					return 'success';

				}else{

					return 'error ' . var_dump( $response_n->getData() );

				}

			}else{

				return 'error ' . var_dump( $response_content->getData() );

			}

		}else{

			return 'error ' . var_dump( $response->getData() );

		}

	}

}