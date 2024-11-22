<?php
/**
 * 将字符串 $data['endtime'] 转换为 DateTime 类型
 *
 * @param array $data 包含 endtime 键的数组
 * @return DateTime 转换后的 DateTime 对象
 * @throws Exception 如果日期格式不正确
 */
function convertToDateTime(array $data) {
    $endTime = $data['endtime'] ?? null;

    if (empty($endTime)) {
        throw new Exception("结束时间不能为空");
    }

    // 检查日期格式是否正确
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $endTime)) {
        throw new Exception("日期格式不正确，应为 YYYY-MM-DD");
    }

    // 创建 DateTime 对象
    $dateTime = DateTime::createFromFormat('Y-m-d', $endTime);

    if (!$dateTime) {
        throw new Exception("无法将日期转换为 DateTime 对象");
    }

    return $dateTime;
}

?>