<?php

namespace Safepay\ApiOperations;

/**
 * Trait for resources that have nested resources.
 *
 * This trait should only be applied to classes that derive from SafepayObject.
 */
trait NestedResource
{
  /**
   * @param 'delete'|'get'|'post' $method
   * @param string $url
   * @param null|array $params
   * @param null|array|string $options
   *
   * @return \Safepay\SafepayObject
   */
  protected static function _nestedResourceOperation($resource, $method, $url, $params = null, $options = null)
  {
    self::_validateParams($params);

    list($response, $opts) = static::_staticRequest($method, $url, $params, $options);
    $obj = \Safepay\Util\Util::convertToSafepayObject($resource, $response->json, $opts);
    $obj->setLastResponse($response);

    return $obj;
  }

  /**
   * @param string $id
   * @param string $nestedPath
   * @param null|string $nestedId
   *
   * @return string
   */
  protected static function _nestedResourceUrl($id, $nestedPath, $nestedId = null)
  {
    $url = static::resourceUrl($id) . $nestedPath;
    if (null !== $nestedId) {
      $url .= "/{$nestedId}";
    }

    return $url;
  }

  /**
   * @param string $id
   * @param string $nestedResource
   * @param string $nestedPath
   * @param null|array $params
   * @param null|array|string $options
   *
   * @throws \Safepay\Exception\ApiErrorException if the request fails
   *
   * @return \Safepay\SafepayObject
   */
  protected static function _createNestedResource($id, $nestedResource, $nestedPath, $params = null, $options = null)
  {
    $url = static::_nestedResourceUrl($id, $nestedPath);

    return self::_nestedResourceOperation($nestedResource, 'post', $url, $params, $options);
  }

  /**
   * @param string $id
   * @param string $nestedResource
   * @param string $nestedPath
   * @param null|string $nestedId
   * @param null|array $params
   * @param null|array|string $options
   *
   * @throws \Safepay\Exception\ApiErrorException if the request fails
   *
   * @return \Safepay\SafepayObject
   */
  protected static function _retrieveNestedResource($id, $nestedResource, $nestedPath, $nestedId, $params = null, $options = null)
  {
    $url = static::_nestedResourceUrl($id, $nestedPath, $nestedId);

    return self::_nestedResourceOperation($nestedResource, 'get', $url, $params, $options);
  }

  /**
   * @param string $id
   * @param string $nestedResource
   * @param string $nestedPath
   * @param null|string $nestedId
   * @param null|array $params
   * @param null|array|string $options
   *
   * @throws \Safepay\Exception\ApiErrorException if the request fails
   *
   * @return \Safepay\SafepayObject
   */
  protected static function _updateNestedResource($id, $nestedResource, $nestedPath, $nestedId, $params = null, $options = null)
  {
    $url = static::_nestedResourceUrl($id, $nestedPath, $nestedId);

    return self::_nestedResourceOperation($nestedResource, 'post', $url, $params, $options);
  }

  /**
   * @param string $id
   * @param string $nestedResource
   * @param string $nestedPath
   * @param null|string $nestedId
   * @param null|array $params
   * @param null|array|string $options
   *
   * @throws \Safepay\Exception\ApiErrorException if the request fails
   *
   * @return \Safepay\SafepayObject
   */
  protected static function _deleteNestedResource($id, $nestedResource, $nestedPath, $nestedId, $params = null, $options = null)
  {
    $url = static::_nestedResourceUrl($id, $nestedPath, $nestedId);

    return self::_nestedResourceOperation($nestedResource, 'delete', $url, $params, $options);
  }

  /**
   * @param string $id
   * @param string $nestedResource
   * @param string $nestedPath
   * @param null|array $params
   * @param null|array|string $options
   *
   * @throws \Safepay\Exception\ApiErrorException if the request fails
   *
   * @return \Safepay\SafepayObject
   */
  protected static function _allNestedResources($id, $nestedResource, $nestedPath, $params = null, $options = null)
  {
    $url = static::_nestedResourceUrl($id, $nestedPath);

    return self::_nestedResourceOperation($nestedResource, 'get', $url, $params, $options);
  }
}
