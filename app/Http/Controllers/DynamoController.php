<?php

namespace App\Http\Controllers;

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;

class DynamoController extends Controller
{
    protected $dynamoDb;

    public function __construct()
    {
        $this->dynamoDb = new DynamoDbClient([
            'region'  => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
        ]);
    }

    public function storeActivity($userId, $activityType)
    {
        try {
            $this->dynamoDb->putItem([
                'TableName' => 'UserActivity',
                'Item' => [
                    'UserID' => ['S' => $userId],
                    'ActivityType' => ['S' => $activityType],
                    'Timestamp' => ['N' => time()],
                ],
            ]);
            return response()->json(['message' => 'Activity saved!']);
        } catch (DynamoDbException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getActivities($userId)
    {
        try {
            $result = $this->dynamoDb->query([
                'TableName' => 'UserActivity',
                'KeyConditionExpression' => 'UserID = :userId',
                'ExpressionAttributeValues' => [
                    ':userId' => ['S' => $userId],
                ],
            ]);
            return response()->json($result['Items']);
        } catch (DynamoDbException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
