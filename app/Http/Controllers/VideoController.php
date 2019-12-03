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

class VideoController extends Controller
{
    protected $client;

    public function __construct()
    {
        $configuration = new KalturaConfiguration();
        $configuration->serviceUrl = config('kmc_demo.kaltura_service_url');
        $this->client = new KalturaClient($configuration);
        $admin_secret = "1fbafe3da6dd392124590b1ea7f7e5a5";
        $type = KalturaSessionType::ADMIN;
        $partner_id = 99;
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

            return view('video.index', compact('entries', 'urlShow'));
        } catch (KalturaClientException $e) {
            dd($e->getMessage());
        } catch (KalturaException $e) {
            dd($e->getMessage());
        }
    }

    public function create()
    {
        return view('video.create');
    }

    public function edit($entry_id)
    {
        $entry = Entry::find($entry_id);
//        $entryId = "0_ciczw5qp";
        $flavors = $this->client->flavorAsset->getByEntryId($entry_id);
        foreach ($flavors as $flavor) {
//                var_dump($flavor->flavorParamsId);
//                $dataTempFlavor = $this->client->flavorAsset->geturl($flavor->id);
            if ($flavor->status == 2 && $flavor->flavorParamsId == 0) {
//                    $data = $this->client->flavorAsset->convert($entryId, $flavor->flavorParamsId);

                $urlShow = $this->client->flavorAsset->geturl($flavor->id);
            }
        }
//        dd($urlShow);
        return view('video.edit', compact('urlShow'));
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
}
