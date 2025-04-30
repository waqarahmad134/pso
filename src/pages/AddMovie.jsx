import React, { useEffect, useState } from 'react';
import GetAPI from '../utilities/GetAPI';
import { PostAPI } from '../utilities/PostAPI';
import { inputStyle, labelStyle } from '../utilities/Input';
import {
  info_toaster,
  mini_toaster,
  success_toaster,
} from '../utilities/Toaster';
import Select from 'react-select';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { useLocation, useNavigate } from 'react-router-dom';
import secureLocalStorage from 'react-secure-storage';

export default function AddMovie() {
  const navigate = useNavigate();
  const quality = GetAPI('quality');


    const waqar = [
      {
          "value": 1,
          "label": "Thokar Pump"
      },
      {
          "value": 2,
          "label": "Johar Pump"
      },
      {
          "value": 3,
          "label": "Township Pump"
      },
      {
          "value": 4,
          "label": "Valencia Pump"
      },
      {
          "value": 5,
          "label": "Canal Pump"
      },
      {
          "value": 6,
          "label": "Bahria Pump"
      },
      {
          "value": 7,
          "label": "Jublee Pump"
      }
  ]

  const [loader, setLoader] = useState(false);
  const [disabled, setDisabled] = useState(false);
  const [addMovie, setAddMovie] = useState({
    title: '',
    thumbnail: null,
    images: [],
    meta_description: '',
    description: '',
    url: '',
    download_link1: '',
    download_link2: '',
    download_link3: '',
    download_link4: '',
    download_link5: '',
    download_link6: '',
    download_link7: '',
    download_link8: '',
    download_link9: '',
    download_link10: '',
    iframe_link1: '',
    iframe_link2: '',
    iframe_link3: '',
    iframe_link4: '',
    iframe_link5: '',
    iframe_link6: '',
    iframe_link7: '',
    iframe_link8: '',
    iframe_link9: '',
    iframe_link10: '',
    iframePosition1: '',
    iframePosition2: '',
    iframePosition3: '',
    iframePosition4: '',
    iframePosition5: '',
    iframePosition6: '',
    iframePosition7: '',
    iframePosition8: '',
    iframePosition9: '',
    iframePosition10: '',
    year: '',
    duration: '',
    director: '',
    uploadBy: secureLocalStorage.getItem('name'),
    category_ids: [],
    quality_ids: [],
    actors_ids: [],
    actresses_ids: [],
    south_actor_ids: [],
    tags_ids: [],
    seasons_ids: [],
  });

  const onChange = (e) => {
    if (e?.target?.type === 'file') {
      if (e.target.name === 'images') {
        setAddMovie({
          ...addMovie,
          [e.target.name]: [...addMovie.images, ...e.target.files],
        });
      } else {
        setAddMovie({ ...addMovie, [e.target.name]: e.target.files[0] });
      }
    } else if (e?.target) {
      const value = e?.target?.name?.endsWith('ids')
        ? Array.from(e.target.selectedOptions, (option) =>
            option.value.toString(),
          )
        : e?.target?.value;
      setAddMovie({ ...addMovie, [e.target?.name]: value });
    } else {
      const { name, value } = e;
      setAddMovie((prevState) => ({
        ...prevState,
        [name]: value.map((option) => option.value.toString()),
      }));
    }
  };

  const addMovieFunc = async (e) => {
    e.preventDefault();
    const {
      title,
      description,
      thumbnail,
      images,
      meta_description,
      url,
      year,
      duration,
      director,
      uploadBy,
      category_ids,
      quality_ids,
      actors_ids,
      actresses_ids,
      south_actor_ids,
      tags_ids,
      seasons_ids,
    } = addMovie;
    if (title === '') {
      info_toaster('Please Enter Title');
    } else {
      setLoader(true);
      const formData = new FormData();
      formData.append('title', title);
      formData.append('description', description || title);
      formData.append('url', url);
      formData.append('meta_description', meta_description || title);
      for (let i = 1; i <= 10; i++) {
        formData.append(
          `download_link${i}`,
          addMovie[`download_link${i}`] || '',
        );
      }

      for (let i = 1; i <= 10; i++) {
        formData.append(`iframe_link${i}`, addMovie[`iframe_link${i}`] || '');
        formData.append(
          `iframeMobile${i}`,
          addMovie[`iframeMobile${i}`] ? 1 : 0,
        );
      }

      formData.append('thumbnail', thumbnail);
      formData.append('year', year);
      formData.append('duration', duration);
      formData.append('director', director);
      formData.append('uploadBy', uploadBy);
      images?.forEach((images, index) => {
        formData.append(`images[]`, images);
      });
      category_ids.forEach((id) => formData.append('category_ids[]', id));
      quality_ids.forEach((id) => formData.append('quality_ids[]', id));
      actors_ids.forEach((id) => formData.append('actors_ids[]', id));
      actresses_ids.forEach((id) => formData.append('actresses_ids[]', id));
      south_actor_ids.forEach((id) => formData.append('south_actor_ids[]', id));
      tags_ids.forEach((id) => formData.append('tags_ids[]', id));
      seasons_ids.forEach((id) => formData.append('seasons_ids[]', id));
      const transformedData = {
        ...addMovie,
        ...Object.fromEntries(
          Object.keys(addMovie)
            .filter((key) => key.startsWith('iframeMobile'))
            .map((key) => [key, addMovie[key] ? true : false]),
        ),
      };
      try {
        let res = await PostAPI('add-movie', formData);
        console.log('🚀 ~ addMovieFunc ~ res:', res);
        if (res?.data?.status === true) {
          setLoader(false);
          success_toaster(res?.data?.message);
          navigate('/');
          setAddMovie({
            title: '',
            thumbnail: null,
            meta_description: '',
            description: '',
            url: '',
            download_link1: '',
            download_link2: '',
            download_link3: '',
            download_link4: '',
            download_link5: '',
            download_link6: '',
            download_link7: '',
            download_link8: '',
            download_link9: '',
            download_link10: '',
            iframe_link1: '',
            iframe_link2: '',
            iframe_link3: '',
            iframe_link4: '',
            iframe_link5: '',
            iframe_link6: '',
            iframe_link7: '',
            iframe_link8: '',
            iframe_link9: '',
            iframe_link10: '',
            iframeMobile1: '',
            iframeMobile2: '',
            iframeMobile3: '',
            iframeMobile4: '',
            iframeMobile5: '',
            iframeMobile6: '',
            iframeMobile7: '',
            iframeMobile8: '',
            iframeMobile9: '',
            iframeMobile10: '',
            year: '',
            duration: '',
            uploadBy: '',
            director: '',
            category_ids: [],
            quality_ids: [],
            actors_ids: [],
            actresses_ids: [],
            south_actor_ids: [],
            tags_ids: [],
            seasons_ids: [],
          });
        } else {
          setLoader(false);
          info_toaster(res?.data?.message);
        }
      } catch (error) {
        console.log('🚀 ~ addMovieFunc ~ error:', error);
        setLoader(false);
        info_toaster('An error occurred while adding the Movie.');
      }
    }
  };

  return (
    <>
      <DefaultLayout>
        <Breadcrumb pageName="Add New Entry" />
        <form>
          <div>
            <div className="space-y-5">
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="title">
                    Name
                  </label>
                  <input
                    value={addMovie?.title}
                    onChange={onChange}
                    type="text"
                    name="title"
                    id="title"
                    placeholder="Movie Name"
                    className={inputStyle}
                  />
                </div>

                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="year">
                    Year
                  </label>
                  <input
                    value={addMovie?.year}
                    onChange={onChange}
                    type="text"
                    name="year"
                    id="year"
                    placeholder="Year"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="images">
                    Image
                  </label>
                  <input
                    onChange={onChange}
                    type="file"
                    name="images"
                    id="images"
                    placeholder="images"
                    className={inputStyle}
                    multiple
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="description">
                    Description
                  </label>
                  <textarea
                    value={addMovie?.description}
                    onChange={onChange}
                    name="description"
                    id="description"
                    placeholder="Description"
                    className={inputStyle}
                    rows="5"
                  ></textarea>
                </div>
              </div>
              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link1">
                    Data
                  </label>
                  <input
                    value={addMovie?.download_link1}
                    onChange={onChange}
                    type="text"
                    name="download_link1"
                    id="download_link1"
                    placeholder="data"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between items-center`}
                    htmlFor="iframe_link1"
                  >
                    Data
                  </label>
                  <input
                    value={addMovie?.iframe_link1}
                    onChange={onChange}
                    type="text"
                    name="iframe_link1"
                    id="iframe_link1"
                    placeholder="data"
                    className={inputStyle}
                  />
                </div>
              </div>
              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link1">
                    Data
                  </label>
                  <input
                    value={addMovie?.download_link1}
                    onChange={onChange}
                    type="text"
                    name="download_link1"
                    id="download_link1"
                    placeholder="data"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between items-center`}
                    htmlFor="iframe_link1"
                  >
                    Data
                  </label>
                  <input
                    value={addMovie?.iframe_link1}
                    onChange={onChange}
                    type="text"
                    name="iframe_link1"
                    id="iframe_link1"
                    placeholder="data"
                    className={inputStyle}
                  />
                </div>
              </div>

              {/* <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link6">
                    Download Link 6
                  </label>
                  <input
                    value={addMovie?.download_link6}
                    onChange={onChange}
                    type="text"
                    name="download_link6"
                    id="download_link6"
                    placeholder="download_link6"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between items-center`}
                    htmlFor="iframe_link6"
                  >
                    Iframe Link 6
                    <div className="flex items-center gap-x-2">
                      Show in Mobile
                      <input
                        onChange={onChange}
                        name="iframeMobile6"
                        type="checkbox"
                      />
                    </div>
                  </label>
                  <input
                    value={addMovie?.iframe_link6}
                    onChange={onChange}
                    type="text"
                    name="iframe_link6"
                    id="iframe_link6"
                    placeholder="iframe_link6"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link7">
                    Download Link 7
                  </label>
                  <input
                    value={addMovie?.download_link7}
                    onChange={onChange}
                    type="text"
                    name="download_link7"
                    id="download_link7"
                    placeholder="download_link7"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between items-center`}
                    htmlFor="iframe_link7"
                  >
                    Iframe Link 7
                    <div className="flex items-center gap-x-2">
                      Show in Mobile
                      <input
                        onChange={onChange}
                        name="iframeMobile7"
                        type="checkbox"
                      />
                    </div>
                  </label>
                  <input
                    value={addMovie?.iframe_link7}
                    onChange={onChange}
                    type="text"
                    name="iframe_link7"
                    id="iframe_link7"
                    placeholder="iframe_link7"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link8">
                    Download Link 8
                  </label>
                  <input
                    value={addMovie?.download_link8}
                    onChange={onChange}
                    type="text"
                    name="download_link8"
                    id="download_link8"
                    placeholder="download_link8"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between items-center`}
                    htmlFor="iframe_link8"
                  >
                    Iframe Link 8
                    <div className="flex items-center gap-x-2">
                      Show in Mobile
                      <input
                        onChange={onChange}
                        name="iframeMobile8"
                        type="checkbox"
                      />
                    </div>
                  </label>
                  <input
                    value={addMovie?.iframe_link8}
                    onChange={onChange}
                    type="text"
                    name="iframe_link8"
                    id="iframe_link8"
                    placeholder="iframe_link8"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link9">
                    Download Link 9
                  </label>
                  <input
                    value={addMovie?.download_link9}
                    onChange={onChange}
                    type="text"
                    name="download_link9"
                    id="download_link9"
                    placeholder="download_link9"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between items-center`}
                    htmlFor="iframe_link9"
                  >
                    Iframe Link 9
                    <div className="flex items-center gap-x-2">
                      Show in Mobile
                      <input
                        onChange={onChange}
                        name="iframeMobile9"
                        type="checkbox"
                      />
                    </div>
                  </label>
                  <input
                    value={addMovie?.iframe_link9}
                    onChange={onChange}
                    type="text"
                    name="iframe_link9"
                    id="iframe_link9"
                    placeholder="iframe_link9"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link10">
                    Download Link 10
                  </label>
                  <input
                    value={addMovie?.download_link10}
                    onChange={onChange}
                    type="text"
                    name="download_link10"
                    id="download_link10"
                    placeholder="download_link10"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between items-center`}
                    htmlFor="iframe_link10"
                  >
                    Iframe Link 10
                    <div className="flex items-center gap-x-2">
                      Show in Mobile
                      <input
                        onChange={onChange}
                        name="iframeMobile10"
                        type="checkbox"
                      />
                    </div>
                  </label>
                  <input
                    value={addMovie?.iframe_link10}
                    onChange={onChange}
                    type="text"
                    name="iframe_link10"
                    id="iframe_link10"
                    placeholder="iframe_link10"
                    className={inputStyle}
                  />
                </div>
              </div> */}

              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="duration">
                    Duration
                  </label>
                  <input
                    value={addMovie?.duration}
                    onChange={onChange}
                    type="text"
                    name="duration"
                    id="duration"
                    placeholder="duration"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="director">
                    Director
                  </label>
                  <input
                    value={addMovie?.director}
                    onChange={onChange}
                    type="text"
                    name="director"
                    id="director"
                    placeholder="director"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="uploadBy">
                    Uploaded By
                  </label>
                  <input
                    value={addMovie?.uploadBy}
                    onChange={onChange}
                    type="text"
                    name="uploadBy"
                    id="uploadBy"
                    placeholder="uploadBy"
                    className={inputStyle}
                    readOnly
                  />
                </div>
              </div>
              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="quality_ids">
                    Select
                  </label>
                  <Select
                    onChange={(selectedOptions) =>
                      onChange({
                        name: 'quality_ids',
                        value: selectedOptions,
                      })
                    }
                    name="quality_ids"
                    isMulti
                    options={waqar}
                  />
                </div>
              </div>
        
             
            </div>
          </div>
          <div className="flex justify-end gap-x-2 mt-5">
            <button
              type="submit"
              onClick={addMovieFunc}
              disabled={disabled}
              className="py-2.5 w-24 rounded font-medium text-sm text-white bg-graydark border"
            >
              Add
            </button>
          </div>
        </form>
      </DefaultLayout>
    </>
  );
}
