import React, { useState } from 'react';
import GetAPI from '../utilities/GetAPI';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';


export default function Movies() {
  return (
    <DefaultLayout>
      <Breadcrumb pageName="Dashboard" />
      <div className="flex flex-col gap-10">
        
      </div>
    </DefaultLayout>
  );
}
