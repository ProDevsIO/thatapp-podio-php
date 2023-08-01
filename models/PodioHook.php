<?php
/**
 * @see https://developers.podio.com/doc/hooks
 */
class PodioHook extends PodioObject
{
    public function __construct($attributes = array())
    {
        parent::__construct();
        $this->property('hook_id', 'integer', array('id' => true));
        $this->property('status', 'string');
        $this->property('type', 'string');
        $this->property('url', 'string');
        $this->property('created_on', 'datetime');

        $this->has_one('created_by', 'ByLine');
        $this->has_one('created_via', 'Via');

        $this->init($attributes);
    }

    /**
     * @see https://developers.podio.com/doc/hooks/get-hooks-215285
     */
    public static function get_for(PodioClient $podio_client, $ref_type, $ref_id)
    {
        return self::listing($podio_client, $podio_client->get("/hook/{$ref_type}/{$ref_id}/"));
    }

    /**
     * @see https://developers.podio.com/doc/hooks/create-hook-215056
     */
    public static function create(PodioClient $podio_client, $ref_type, $ref_id, $attributes = array())
    {
        $body = $podio_client->post("/hook/{$ref_type}/{$ref_id}/", $attributes)->json_body();
        return $body['hook_id'];
    }

    /**
     * @see https://developers.podio.com/doc/hooks/request-hook-verification-215232
     */
    public static function verify(PodioClient $podio_client, $hook_id)
    {
        return $podio_client->post("/hook/{$hook_id}/verify/request")->json_body();
    }

    /**
     * @see https://developers.podio.com/doc/hooks/validate-hook-verification-215241
     */
    public static function validate(PodioClient $podio_client, $hook_id, $attributes = array())
    {
        return $podio_client->post("/hook/{$hook_id}/verify/validate", $attributes)->json_body();
    }

    /**
     * @see https://developers.podio.com/doc/hooks/delete-hook-215291
     */
    public static function delete(PodioClient $podio_client, $hook_id)
    {
        return $podio_client->delete("/hook/{$hook_id}");
    }
}
