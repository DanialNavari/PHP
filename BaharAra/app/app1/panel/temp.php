<!--<table style="text-align: center;display:inline;">
                                            <tr>
                                                <th colspan="12">ساعت کاری</th>
                                            </tr>
                                            <tr>
                                                <td colspan="12">
                                                <?php $ratio = ($total_visit_time / 32400) * 100; ?>
                                                    <div class="progress" style="height: 1rem;direction: ltr;">
                                                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo intval($ratio); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo intval($ratio); ?>%">
                                                            <?php echo intval($ratio); ?>%
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr style="border: 2px solid #000; border-top: none; border-right: none; border-left: none;">
                                                <td colspan="6" style="border: 2px solid #000; border-top: none; border-right: 1px solid silver;">صبح</td>
                                                <td colspan="6">عصر</td>
                                            </tr>
                                            <tr>
                                                <td>شروع</td>
                                                <td>شهر</td>
                                                <td style="border: 2px solid #000; border-bottom: none; border-top: none; border-right: none;">منطقه</td>
                                                <td>پایان</td>
                                                <td>شهر</td>
                                                <td style="border: 2px solid #000; border-bottom: none; border-top: none; border-right: none;">منطقه</td>

                                                <td>شروع</td>
                                                <td>شهر</td>
                                                <td style="border: 2px solid #000; border-bottom: none; border-top: none; border-right: none;">منطقه</td>
                                                <td>پایان</td>
                                                <td>شهر</td>
                                                <td>منطقه</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo saat($pp); ?></td>
                                                <td><?php echo $start_morning['city']; ?></td>
                                                <td style="border: 2px solid #000; border-bottom: none; border-top: none; border-right: none;">
                                                    <?php echo $start_morning['hood']; ?>
                                                </td>
                                                <td><?php echo saat($end_morning['zaman']); ?></td>
                                                <td><?php echo $end_morning['city']; ?></td>
                                                <td style="border: 2px solid #000; border-bottom: none; border-top: none; border-right: none;">
                                                    <?php echo $end_morning['hood']; ?>
                                                </td>
                                                <td><?php echo saat($start_evening['zaman']); ?></td>
                                                <td><?php echo $start_evening['city']; ?></td>
                                                <td style="border: 2px solid #000; border-bottom: none; border-top: none; border-right: none;">
                                                    <?php echo $start_evening['hood']; ?>
                                                </td>
                                                <td><?php echo saat($end_evening['zaman']); ?></td>
                                                <td><?php echo $end_evening['city']; ?></td>
                                                <td>
                                                    <?php echo $end_evening['hood']; ?>
                                                </td>
                                            </tr>

                                        </table>-->

<a target='_blank' href='factor.php?date=" . $_GET[' date'] . "&factor_id=" . $data_log[$i]['factor_id'] . "'>" . $data_log[$i]['factor_id'] . "</a>