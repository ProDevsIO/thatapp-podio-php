<?php
/**
 * @see https://developers.podio.com/doc/subscriptions
 */
class PodioSubscription extends PodioObject
{
    public function __construct(PodioClient $podio_client, $attributes = array())
    {
        parent::__construct($podio_client);
        $this->property('started_on', 'datetime');
        $this->property('notifications', 'integer');

        $this->has_one('ref', 'Reference');

        $this->init($attributes);
    }

    /**
     * @see https://developers.podio.com/doc/subscriptions/get-subscription-by-id-22446
     */
    public static function get($subscription_id, PodioClient $podio_client)
    {
        return self::member($podio_client->get("/subscription/{$subscription_id}"), $podio_client);
    }

    /**
     * @see https://developers.podio.com/doc/subscriptions/get-subscription-by-reference-22408
     */
    public static function get_for($ref_type, $ref_id, PodioClient $podio_client)
    {
        return self::member($podio_client->get("/subscription/{$ref_type}/{$ref_id}"), $podio_client);
    }

    /**
     * @see https://developers.podio.com/doc/subscriptions/subscribe-22409
     */
    public static function create($ref_type, $ref_id, PodioClient $podio_client)
    {
        return $podio_client->post("/subscription/{$ref_type}/{$ref_id}")->json_body();
    }

    /**
     * @see https://developers.podio.com/doc/subscriptions/unsubscribe-by-id-22445
     */
    public static function delete($subscription_id, PodioClient $podio_client)
    {
        return $podio_client->delete("/subscription/{$subscription_id}");
    }

    /**
     * @see https://developers.podio.com/doc/subscriptions/unsubscribe-by-reference-22410
     */
    public static function delete_for($ref_type, $ref_id, PodioClient $podio_client)
    {
        return $podio_client->delete("/subscription/{$ref_type}/{$ref_id}");
    }
}
