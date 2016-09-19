<a href ="" onclick = "document.getElementById('<?=$dideo_info->video_title; ?>').style.display='none';document.getElementById('fade').style.display='none'"><button>Close</button> </a>
                                        
                                        <a id="<?=$dideo_info->video_id; ?>" href ="javascript:void(0)" onclick = "document.getElementById('<?= next($dideo_info->video_id); ?>').style.display='block';document.getElementById('fade').style.display='block'">
                                            <button  type="button">Next Video</button>
                                        </a>
                                            <button onclick="pauseVid()" type="button">Pause Video</button><br> 
                                        <button href = "" onclick="document.getElementById('<?=$value->section_name?>').pause()" type="button">Next Section</button><br> 
                                        <button onclick="playVid()" type="button">Play Video</button>
