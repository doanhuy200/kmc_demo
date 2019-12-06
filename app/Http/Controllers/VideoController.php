<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KalturaClient;
use KalturaConfiguration;
use KalturaFilterPager;
use KalturaClientException;
use KalturaException;
use KalturaSessionType;
use KalturaMediaEntry;
use KalturaMediaType;
use KalturaAssetFilter;
use KalturaMediaEntryFilter;
use KalturaEntryStatus;
use App\Entry;
use App\Enums\FlavorParamsVideoType;
use App\Enums\FlavorAssetStatus;

class VideoController extends Controller
{
    protected $client;

    public function __construct()
    {
        $configuration = new KalturaConfiguration();
        $configuration->serviceUrl = config('kmc_demo.kaltura_service_url');
        $this->client = new KalturaClient($configuration);
        $admin_secret = "85ef214870879852c802800efa2d3207";
        $type = KalturaSessionType::ADMIN;
        $partner_id = 100;
        $ks = $this->client->session->start($admin_secret, null, $type, $partner_id);
        $this->client->setKs($ks);
    }

    public function index()
    {
        try {
//            $admin_session = $this->client->user->loginByLoginId(config('kmc_demo.admin_console_admin_mail'), config('kmc_demo.admin_console_password'));
//            dd($admin_session);

//            $thumbAssetFilter = new KalturaAssetFilter();
//            $thumbAssetFilter->entryIdEqual = "0_2ygaqv01";
//            $thumbAssetFilter->tagsLike = 'default_thumb';
            $filter = new KalturaMediaEntryFilter();
            $filter->mediaTypeEqual = KalturaMediaType::VIDEO;

            $filter->statusIn = KalturaEntryStatus::ERROR_IMPORTING.','
                .KalturaEntryStatus::ERROR_CONVERTING.','
                .KalturaEntryStatus::IMPORT.','
                .KalturaEntryStatus::PRECONVERT.','
                .KalturaEntryStatus::READY.','
                .KalturaEntryStatus::PENDING.','
                .KalturaEntryStatus::MODERATE.','
                .KalturaEntryStatus::BLOCKED;

            $entryTotal = $this->client->baseEntry->listAction()->totalCount;
            $pagerDefault = new KalturaFilterPager();
            $pagerDefault->pageSize = $entryTotal;
            $pagerDefault->pageIndex = 1;
            $entryStocks = $this->client->baseEntry->listAction($filter, $pagerDefault);
            $entries = $entryStocks->objects;
//            dd($entries);


            return view('video.index', compact('entries'));
        } catch (KalturaClientException $e) {
            dd($e->getMessage());
        } catch (KalturaException $e) {
            dd($e->getMessage());
        }
    }

    public function preview($entry_id)
    {
//        $flavors = $this->client->flavorAsset->getByEntryId($entry_id);
//        $urlShow = "";
//        foreach ($flavors as $flavor) {
//            if ($flavor->status == 2 && $flavor->flavorParamsId == 0) {
//                $urlShow = $this->client->flavorAsset->geturl($flavor->id);
//            }
//        }
        $flavors = $this->client->flavorAsset->getByEntryId($entry_id);

        foreach ($flavors as $i => $flavor) {
            if ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x400) {
                $j = FlavorParamsVideoType::WEB_H264x400;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x600) {
                $j = FlavorParamsVideoType::WEB_H264x600;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x900) {
                $j = FlavorParamsVideoType::WEB_H264x900;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x1500) {
                $j = FlavorParamsVideoType::WEB_H264x1500;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x2500) {
                $j = FlavorParamsVideoType::WEB_H264x2500;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x4000) {
                $j = FlavorParamsVideoType::WEB_H264x4000;
            } else {
                $j = FlavorParamsVideoType::WEB_NOT_VIDEO;
            }

            try {
                if ($flavor->status == FlavorAssetStatus::READY) {
                    $url = $this->client->flavorAsset->geturl($flavor->id);
                    $urlShow[$j]['url'] = $url;
                    $urlShow[$j]['bitrate'] = $flavor->bitrate . ' Kbps';
                    $urlShow[$j]['framerate'] = $flavor->frameRate;
                    $urlShow[$j]['size'] = $flavor->width . " x " . $flavor->height;
                    $urlShow[$j]['width'] = $flavor->width;
                    $urlShow[$j]['height'] = $flavor->height;
                    $urlShow[$j]['id'] = $flavor->id;
                    $urlShow[$j]['entryId'] = $flavor->entryId;
                }
            } catch (Exception $e) {

            }

        }
//        dd(json_encode($urlShow));

        return response()->json(['urlShow' => $urlShow], 200);
    }

    public function create()
    {
        return view('video.create');
    }

    public function edit($entry_id)
    {
//        $entry = Entry::find($entry_id);
//        $urlShow = "";
        $flavors = $this->client->flavorAsset->getByEntryId($entry_id);

        foreach ($flavors as $i => $flavor) {
            if ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x400) {
                $j = FlavorParamsVideoType::WEB_H264x400;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x600) {
                $j = FlavorParamsVideoType::WEB_H264x600;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x900) {
                $j = FlavorParamsVideoType::WEB_H264x900;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x1500) {
                $j = FlavorParamsVideoType::WEB_H264x1500;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x2500) {
                $j = FlavorParamsVideoType::WEB_H264x2500;
            } elseif ($flavor->flavorParamsId == FlavorParamsVideoType::WEB_H264x4000) {
                $j = FlavorParamsVideoType::WEB_H264x4000;
            } else {
                $j = FlavorParamsVideoType::WEB_NOT_VIDEO;
            }

            try {
                if ($flavor->status == FlavorAssetStatus::READY) {
                    $url = $this->client->flavorAsset->geturl($flavor->id);
                    $urlShow[$j]['url'] = $url;
                    $urlShow[$j]['bitrate'] = $flavor->bitrate . ' Kbps';
                    $urlShow[$j]['framerate'] = $flavor->frameRate;
                    $urlShow[$j]['size'] = $flavor->width . " x " . $flavor->height;
                    $urlShow[$j]['width'] = $flavor->width;
                    $urlShow[$j]['height'] = $flavor->height;
                    $urlShow[$j]['id'] = $flavor->id;
                    $urlShow[$j]['entryId'] = $flavor->entryId;
                }
            } catch (Exception $e) {

            }
        }
//        dd($urls);

//        foreach ($flavors as $flavor) {
//            if ($flavor->status == 2 && $flavor->flavorParamsId == 0) {
//                $urlShow = $this->client->flavorAsset->geturl($flavor->id);
//            }
//        }
//        dd($urlShow);

        return view('video.edit', compact('urlShow'));
//        return view('video.edit');
    }
    
    public function store(Request $request)
    {
        try {
            $token = $this->client->baseEntry->upload($request->file('file'));
            $entry = new KalturaMediaEntry();

            $fileType = $request->file('file')->getClientOriginalExtension();
            $fileMimeType = $request->file('file')->getMimeType();
            if($fileMimeType == "video/mp4" || $fileMimeType == "video/quicktime") {
                $newName = $request->file('file')->getClientOriginalName();
                $entry->name = str_replace('.' . $fileType, '', $newName);
                $entry->mediaType = KalturaMediaType::VIDEO;
                $this->client->media->addFromUploadedFile($entry, $token);

                return redirect()->route('video.index');
            }
            dd("Video not .mp4 or .mov");
        } catch (KalturaClientException $e) {
            dd($e->getMessage());
        } catch (\Exception $exception) {
            dd("Convert error");
        }

    }

    public function delete($entry_id)
    {
        try {
            $this->client->baseEntry->delete($entry_id);

            return redirect()->route('video.index');
        } catch (KalturaException $exception) {
            dd($exception->getMessage());
        }
    }
}
