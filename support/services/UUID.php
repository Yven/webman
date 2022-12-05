<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support\services;

use Godruoyi\Snowflake\RedisSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use support\exception\SupportException;
use support\Redis;

/**
 * @Description
 * UUID生成器，用于生成系统内需要用到唯一id
 *
 * @Class  : UUID
 * @Package: support\services
 */
class UUID
{
    /**
     * 雪花算法uuid生成器https://github.com/godruoyi/php-snowflake
     *
     * 第一个 bit 为未使用的符号位。
     *
     * 第二部分由 41 位的时间戳（毫秒）构成，他的取值是当前时间相对于某一时间的偏移量。
     *
     * 第三部分和第四部分的 5 个 bit 位表示数据中心和机器ID，其能表示的最大值为 2^5 -1 = 31。
     *
     * 最后部分由 12 个 bit 组成，其表示每个工作节点每毫秒生成的序列号 ID，同一毫秒内最多可生成 2^12 -1 即 4095 个 ID。
     *
     * 需要注意的是：
     * 在分布式环境中，5 个 bit 位的 datacenter 和 worker 表示最多能部署 31 个数据中心，每个数据中心最多可部署 31 台节点
     * 41 位的二进制长度最多能表示 2^41 -1 毫秒即 69 年，所以雪花算法最多能正常使用 69 年，为了能最大限度的使用该算法，你应该为其指定一个开始时间。
     * 由上可知，雪花算法生成的 ID 并不能保证唯一，如当两个不同请求同一时刻进入相同的数据中心的相同节点时，而此时该节点生成的 sequence 又是相同时，就会导致生成的 ID 重复。
     * @static
     *
     * @param int $datacenterId 数据中心ID，最大值为31，否则会随机生成
     * @param int $workerId     机器ID
     *
     * @return string
     * @throws SupportException
     */
    public static function snowflake(int $datacenterId = 0, int $workerId = 0): string
    {
        try {
            return (new Snowflake($datacenterId, $workerId))
                ->setStartTimeStamp(strtotime('2022-12-01') * 1000)
                ->setSequenceResolver(new RedisSequenceResolver(Redis::instance()))
                ->id();
        } catch (\Exception $e) {
            throw new SupportException($e->getMessage(), $e->getCode());
        }
    }
}