import { useState } from 'react';
import axios from 'axios';
import UploadVideo from './UploadVideo';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';

export default function VideoUpload() {
  return (
    <DefaultLayout>
      <Breadcrumb pageName="Video Logo Tool" />
      <UploadVideo />
    </DefaultLayout>
  );
}
