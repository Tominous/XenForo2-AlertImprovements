<?php

namespace SV\AlertImprovements\XF\Alert;

use SV\AlertImprovements\ISummarizeAlert;

/**
 * Class User
 *
 * @package SV\AlertImprovements\XF\Alert
 */
class User extends XFCP_User implements ISummarizeAlert
{
    use SummarizeAlertTrait;

    /**
     * @param array $optOuts
     * @return bool
     */
    public function canSummarizeForUser(array $optOuts)
    {
        return true;
    }

    /**
     * @param array $alert
     * @return bool
     */
    public function canSummarizeItem(array $alert)
    {
        switch ($alert['content_type'])
        {
            case 'profile_post':
            case 'profile_post_comment':
            case 'report_comment':
            case 'conversation_message':
            case 'post':
                $validActions = ['like', 'rating', 'reaction'];

                return in_array($alert['action'], $validActions, true);
            default:
                return false;
        }
    }

    /**
     * @param string $contentType
     * @param int    $contentId
     * @param array  $item
     * @return bool
     */
    public function consolidateAlert(&$contentType, &$contentId, array $item)
    {
        return false;
    }

    /**
     * @param array  $summaryAlert
     * @param array  $alerts
     * @param string $groupingStyle
     * @return array
     */
    public function summarizeAlerts(array $summaryAlert, array $alerts, $groupingStyle)
    {
        $summaryAlert['action'] = $this->getSummaryAction($summaryAlert);

        return $summaryAlert;
    }
}
