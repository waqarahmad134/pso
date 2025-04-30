import React, { useEffect, useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import GetAPI from '../utilities/GetAPI';
import { PostAPI } from '../utilities/PostAPI';
import { inputStyle, labelStyle } from '../utilities/Input';
import { info_toaster, success_toaster } from '../utilities/Toaster';
import Select from 'react-select';

import {
  Modal,
  ModalOverlay,
  ModalContent,
  ModalHeader,
  ModalFooter,
  ModalBody,
  ModalCloseButton,
  useDisclosure,
} from '@chakra-ui/react';
import axios from 'axios';

export default function EditMovie() {
  const { isOpen, onOpen, onClose } = useDisclosure();

  const location = useLocation();
  const navigate = useNavigate();
  const movie = JSON.parse(localStorage.getItem('movieData'));
  const movieId = movie?.id;
  const [youtubeUrl, setYoutubeUrl] = useState('');
  const [googleURL, setGoogleURL] = useState('');
  const extractYouTubeVideoId = (url) => {
    const regExp =
      /^.*(youtu.be\/|v\/|\/u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return match && match[2].length === 11 ? match[2] : null;
  };

  const handleSubmit = async () => {
    if (!youtubeUrl || !movieId) {
      alert(
        'Please provide a valid YouTube URL and ensure the movie ID is available.',
      );
      return;
    }

    // Extract video ID
    const videoId = extractYouTubeVideoId(youtubeUrl);
    if (!videoId) {
      alert('Invalid YouTube URL');
      return;
    }

    try {
      let res = await PostAPI(`save-thumbnail/${videoId}/${movieId}`);
      if (res?.data?.success === 'Thumbnail saved successfully') {
        success_toaster('Thumbnail added successfully');
        navigate('/');
      }
    } catch (error) {
      console.error('Error saving thumbnail:', error);
      alert('Failed to save thumbnail. Please try again.');
    }
  };

  const saveThumbnailFromUrl = async (imageType, e) => {
    e.preventDefault();
    if (!movieId || !googleURL) {
      alert('Movie ID and URL are required.');
      return;
    }
    try {
      let res = await PostAPI(`saveThumbnailFromUrl`, {
        movieId: movieId,
        url: googleURL,
        imageType: imageType,
      });
      if (
        res &&
        res.data &&
        res.data.success === 'Thumbnail saved successfully'
      ) {
        success_toaster('Thumbnail added successfully');
        // navigate('/');
      } else if (
        res &&
        res.data &&
        res.data.success === 'Images updated successfully'
      ) {
        success_toaster('Featured Image Uplaoded Successfully');
      } else {
        alert(res?.data?.error || 'Unexpected error occurred.');
      }
    } catch (error) {
      console.error('Error saving thumbnail:', error);
      alert('Failed to save thumbnail. Please try again.');
    }
  };

  const PreviousCategories =
    movie?.categories?.map((data) => ({
      value: data.id,
      label: data.name,
    })) || [];

  const PreviousQualtity =
    movie?.qualities?.map((data) => ({
      value: data.id,
      label: data.name,
    })) || [];

  const PreviousActors =
    movie?.actors?.map((data) => ({
      value: data.id,
      label: data.name,
    })) || [];

  const PreviousActresses =
    movie?.actresses?.map((data) => ({
      value: data.id,
      label: data.name,
    })) || [];

  const PreviousSeasons =
    movie?.seasons?.map((data) => ({
      value: data.id,
      label: data.name,
    })) || [];

  const PreviouSouthActor =
    movie?.south_actor?.map((data) => ({
      value: data.id,
      label: data.name,
    })) || [];

  const PreviouTags =
    movie?.tags?.map((data) => ({
      value: data.id,
      label: data.name,
    })) || [];

  const handleIsFeatured = (event) => {
    const { checked } = event.target;
    setUpdateMovie((prevState) => ({
      ...prevState,
      isFeatured: checked ? 1 : 0,
    }));
  };

  const [loader, setLoader] = useState(false);
  const [disabled, setDisabled] = useState(false);
  const [editMovie, setUpdateMovie] = useState({
    title: movie.title,
    thumbnail: null,
    images: [],
    meta_description: movie.meta_description,
    description: movie.description,
    isFeatured: movie.isFeatured,
    download_link1: movie.download_link1,
    download_link2: movie.download_link2,
    download_link3: movie.download_link3,
    download_link4: movie.download_link4,
    download_link5: movie.download_link5,
    download_link6: movie.download_link6,
    download_link7: movie.download_link7,
    download_link8: movie.download_link8,
    download_link9: movie.download_link9,
    download_link10: movie.download_link10,

    iframe_link1: movie.iframe_link1,
    iframe_link2: movie.iframe_link2,
    iframe_link3: movie.iframe_link3,
    iframe_link4: movie.iframe_link4,
    iframe_link5: movie.iframe_link5,
    iframe_link6: movie.iframe_link6,
    iframe_link7: movie.iframe_link7,
    iframe_link8: movie.iframe_link8,
    iframe_link9: movie.iframe_link9,
    iframe_link10: movie.iframe_link10,

    iframePosition1: movie.iframePosition1,
    iframePosition2: movie.iframePosition2,
    iframePosition3: movie.iframePosition3,
    iframePosition4: movie.iframePosition4,
    iframePosition5: movie.iframePosition5,
    iframePosition6: movie.iframePosition6,
    iframePosition7: movie.iframePosition7,
    iframePosition8: movie.iframePosition8,
    iframePosition9: movie.iframePosition9,
    iframePosition10: movie.iframePosition10,

    year: movie.year,
    duration: movie.duration,
    director: movie.director,
    uploadBy: movie.uploadBy,
    category_ids: [],
    quality_ids: [],
    actors_ids: [],
    actresses_ids: [],
    south_actor_ids: [],
    tags_ids: [],
    seasons_ids: [],
  });

  const categories = GetAPI('categories');
  const actors = GetAPI('actors');
  const actress = GetAPI('actress');
  const quality = GetAPI('quality');
  const southActors = GetAPI('southactor');
  const tag = GetAPI('tag');
  const seasons = GetAPI('seasons');

  const categoryOptions =
    categories?.data?.data?.map((category) => ({
      value: category.id,
      label: category.name,
    })) || [];

  const actorOptions =
    actors?.data?.data?.map((actor) => ({
      value: actor.id,
      label: actor.name,
    })) || [];

  const actressOptions =
    actress?.data?.data?.map((actress) => ({
      value: actress.id,
      label: actress.name,
    })) || [];

  const qualityOptions =
    quality?.data?.data?.map((quality) => ({
      value: quality.id,
      label: quality.name,
    })) || [];

  const southActorOptions =
    southActors?.data?.data?.map((southActor) => ({
      value: southActor.id,
      label: southActor.name,
    })) || [];

  const tagOptions =
    tag?.data?.data?.map((tag) => ({
      value: tag.id,
      label: tag.name,
    })) || [];

  const seasonOptions =
    seasons?.data?.data?.map((season) => ({
      value: season.id,
      label: season.name,
    })) || [];

  const handleCategoriesChange = (selectedCategories) => {
    setUpdateMovie((prevMovie) => ({
      ...prevMovie,
      category_ids: selectedCategories
        ? selectedCategories.map((cat) => String(cat.value))
        : [],
    }));
  };

  const handleQuality = (selectedQuality) => {
    setUpdateMovie((prevMovie) => ({
      ...prevMovie,
      quality_ids: selectedQuality
        ? selectedQuality.map((cat) => String(cat.value))
        : [],
    }));
  };

  const handleActors = (selectedActors) => {
    setUpdateMovie((prevMovie) => ({
      ...prevMovie,
      actors_ids: selectedActors
        ? selectedActors.map((cat) => String(cat.value))
        : [],
    }));
  };

  const handleActress = (selectedActress) => {
    setUpdateMovie((prevMovie) => ({
      ...prevMovie,
      actresses_ids: selectedActress
        ? selectedActress.map((cat) => String(cat.value))
        : [],
    }));
  };

  const handleSouthActors = (selectedSouthActors) => {
    setUpdateMovie((prevMovie) => ({
      ...prevMovie,
      south_actor_ids: selectedSouthActors
        ? selectedSouthActors.map((cat) => String(cat.value))
        : [],
    }));
  };

  const handleTags = (selectedTags) => {
    setUpdateMovie((prevMovie) => ({
      ...prevMovie,
      tags_ids: selectedTags
        ? selectedTags.map((cat) => String(cat.value))
        : [],
    }));
  };

  const handleSeasons = (selectedSeasons) => {
    setUpdateMovie((prevMovie) => ({
      ...prevMovie,
      seasons_ids: selectedSeasons
        ? selectedSeasons.map((cat) => String(cat.value))
        : [],
    }));
  };

  const onChange = (e) => {
    const { name, value, type, files } = e.target;
    if (type === 'file') {
      if (name === 'images') {
        setUpdateMovie((prevState) => ({
          ...prevState,
          images: [...prevState.images, ...Array.from(files)],
        }));
      } else {
        setUpdateMovie((prevState) => ({
          ...prevState,
          [name]: files[0],
        }));
      }
    } else {
      setUpdateMovie((prevState) => ({
        ...prevState,
        [name]: value,
      }));
    }
  };

  const editMovieFunc = async (e) => {
    if (e) e.preventDefault();
    setLoader(true);
    const {
      title,
      description,
      thumbnail,
      images,
      meta_description,
      isFeatured,
      year,
      duration,
      director,
      uploadBy,
      download_link1,
      download_link2,
      download_link3,
      download_link4,
      download_link5,
      download_link6,
      download_link7,
      download_link8,
      download_link9,
      download_link10,
      iframe_link1,
      iframe_link2,
      iframe_link3,
      iframe_link4,
      iframe_link5,
      iframe_link6,
      iframe_link7,
      iframe_link8,
      iframe_link9,
      iframe_link10,
      iframePosition1,
      iframePosition2,
      iframePosition3,
      iframePosition4,
      iframePosition5,
      iframePosition6,
      iframePosition7,
      iframePosition8,
      iframePosition9,
      iframePosition10,
      category_ids,
      quality_ids,
      actors_ids,
      actresses_ids,
      south_actor_ids,
      tags_ids,
      seasons_ids,
    } = editMovie;

    if (title === '') {
      info_toaster('Please Enter Title');
      setLoader(false);
      return;
    }
    if (description === '') {
      info_toaster('Please Enter description');
      setLoader(false);
      return;
    }

    const formData = new FormData();
    formData.append('title', title);
    formData.append('description', description || '');
    formData.append('isFeatured', isFeatured || '');
    formData.append('meta_description', meta_description || '');
    formData.append('download_link1', download_link1 || '');
    formData.append('download_link2', download_link2 || '');
    formData.append('download_link3', download_link3 || '');
    formData.append('download_link4', download_link4 || '');
    formData.append('download_link5', download_link5 || '');
    formData.append('download_link6', download_link6 || '');
    formData.append('download_link7', download_link7 || '');
    formData.append('download_link8', download_link8 || '');
    formData.append('download_link9', download_link9 || '');
    formData.append('download_link10', download_link10 || '');

    formData.append('iframe_link1', iframe_link1 || '');
    formData.append('iframe_link2', iframe_link2 || '');
    formData.append('iframe_link3', iframe_link3 || '');
    formData.append('iframe_link4', iframe_link4 || '');
    formData.append('iframe_link5', iframe_link5 || '');
    formData.append('iframe_link6', iframe_link6 || '');
    formData.append('iframe_link7', iframe_link7 || '');
    formData.append('iframe_link8', iframe_link8 || '');
    formData.append('iframe_link9', iframe_link9 || '');
    formData.append('iframe_link10', iframe_link10 || '');

    formData.append('iframePosition1', iframePosition1 || '');
    formData.append('iframePosition2', iframePosition2 || '');
    formData.append('iframePosition3', iframePosition3 || '');
    formData.append('iframePosition4', iframePosition4 || '');
    formData.append('iframePosition5', iframePosition5 || '');
    formData.append('iframePosition6', iframePosition6 || '');
    formData.append('iframePosition7', iframePosition7 || '');
    formData.append('iframePosition8', iframePosition8 || '');
    formData.append('iframePosition9', iframePosition9 || '');
    formData.append('iframePosition10', iframePosition10 || '');

    formData.append('year', year || '');
    formData.append('duration', duration || '');
    formData.append('director', director || '');
    formData.append('uploadBy', uploadBy || '');

    if (thumbnail) {
      formData.append('thumbnail', thumbnail);
    }
    if (images.length > 0) {
      images?.forEach((images, index) => {
        formData.append(`images[]`, images);
      });
    }
    category_ids.forEach((category_id) => {
      formData.append('category_ids[]', category_id);
    });
    quality_ids.forEach((quality_id) => {
      formData.append('quality_ids[]', quality_id);
    });
    actors_ids.forEach((actors_id) => {
      formData.append('actors_ids[]', actors_id);
    });
    actresses_ids.forEach((actresses_id) => {
      formData.append('actresses_ids[]', actresses_id);
    });
    south_actor_ids.forEach((south_actor_id) => {
      formData.append('south_actor_ids[]', south_actor_id);
    });
    tags_ids.forEach((tags_id) => {
      formData.append('tags_ids[]', tags_id);
    });
    seasons_ids.forEach((season_id) => {
      formData.append('seasons_ids[]', season_id);
    });
    try {
      let res = await PostAPI(`update-movie/${movie?.id}`, formData);
      if (res?.data?.status === true) {
        success_toaster(res?.data?.message);
        // navigate('/');
      } else {
        success_toaster(res?.data?.message);
      }
    } catch (error) {
      info_toaster('An error occurred while editing the Movie.');
    } finally {
      setLoader(false);
    }
  };

  const handlePositionChange = (event) => {
    const { name, value } = event.target;
    const iframePositions = Object.keys(editMovie)
      .filter((key) => key.startsWith('iframePosition'))
      .map((key) => editMovie[key]);
    if (iframePositions.includes(value)) {
      const existingPosition = Object.keys(editMovie).find(
        (key) => editMovie[key] === value && key.startsWith('iframePosition'),
      );
      info_toaster(`Already assigned to ${existingPosition}`);
      return;
    }
    setUpdateMovie((prevState) => ({
      ...prevState,
      [name]: value,
    }));
  };

  return (
    <>
      <DefaultLayout>
        <Modal isOpen={isOpen} onClose={onClose}>
          <ModalOverlay />
          <ModalContent>
            <ModalHeader>
              Add movie url from youtube to grab thumbnail
            </ModalHeader>
            <ModalCloseButton />
            <ModalBody>
              <div>
                <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                  URL
                </label>
                Youtube :
                <input
                  type="text"
                  value={youtubeUrl}
                  onChange={(e) => setYoutubeUrl(e.target.value)}
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                Google :
                <input
                  type="text"
                  value={googleURL}
                  onChange={(e) => setGoogleURL(e.target.value)}
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
              </div>
              <div className="flex gap-4">
                <button
                  onClick={handleSubmit}
                  className="my-3 bg-red-500 px-3 py-1 rounded-md text-white float-end"
                >
                  Submit Youtube
                </button>
                <button
                  onClick={(e) => saveThumbnailFromUrl('thumbnail', e)}
                  className="my-3 bg-slate-500 px-3 py-1 rounded-md text-white float-end"
                >
                  Submit Google
                </button>
              </div>
            </ModalBody>
          </ModalContent>
        </Modal>
        <Breadcrumb pageName="Edit Movie" />
        <div className="text-end">
          <button
            type="submit"
            onClick={editMovieFunc}
            disabled={disabled}
            className="py-2.5 w-24 rounded font-medium text-sm text-white bg-graydark border"
          >
            Update
          </button>
        </div>
        <form>
          <div>
            <div className="space-y-5">
              <div className="grid grid-cols-12 gap-x-4">
                <div className="col-span-6 space-y-1 w-full">
                  <label className={labelStyle} htmlFor="title">
                    Movie Name
                  </label>
                  <input
                    value={editMovie?.title}
                    onChange={onChange}
                    type="text"
                    name="title"
                    id="title"
                    placeholder="Movie Name"
                    className={inputStyle}
                  />
                </div>
                <div className="col-span-6 space-y-1 w-full">
                  <label className={labelStyle} htmlFor="year">
                    Year
                  </label>
                  <input
                    value={editMovie?.year}
                    onChange={onChange}
                    type="text"
                    name="year"
                    id="year"
                    placeholder="Year"
                    className={inputStyle}
                  />
                </div>

                <div className="col-span-4 space-y-1 w-full mt-5">
                  <label
                    className={`${labelStyle} flex justify-between w-full items-center`}
                  >
                    Thumbnail
                    <div
                      onClick={onOpen}
                      className="bg-blue-500 rounded-md text-white px-3 py-1 cursor-pointer"
                    >
                      Uplaod by Link
                    </div>
                    <a
                      className="bg-red-500 rounded-md text-white px-3 py-1"
                      target="_blank"
                      href={`https://www.youtube.com/results?search_query=${movie?.slug}`}
                    >
                      Youtube
                    </a>
                    <a
                      className="bg-red-500 rounded-md text-white px-3 py-1"
                      target="_blank"
                      onClick={(e) => {
                        e.preventDefault();
                        const title = movie?.title || '';
                        const match = title.match(/^(.*\(\d{4}\))/);
                        const sanitizedTitle = match ? match[0] : title;
                        window.open(
                          `https://www.google.com/search?hl=en&tbm=isch&q=${encodeURIComponent(
                            sanitizedTitle,
                          )}`,
                          '_blank',
                        );
                        window.open(
                          `https://www.google.com/search?q=${encodeURIComponent(
                            sanitizedTitle,
                          )}+release+date`,
                          '_blank',
                        );
                      }}
                    >
                      Google
                    </a>
                  </label>
                  <input
                    onChange={onChange}
                    type="file"
                    name="thumbnail"
                    id="thumbnail"
                    placeholder="thumbnail"
                    className={`${inputStyle} + h-[44px]`}
                  />
                  <div className="flex items-center gap-2">
                    <input
                      type="text"
                      // value={googleURL}
                      onChange={(e) => setGoogleURL(e.target.value)}
                      className={`${inputStyle} + h-[44px] bg-green-400`}
                    />
                    <button
                      onClick={(e) => saveThumbnailFromUrl('thumbnail', e)}
                      className="my-3 bg-slate-500 px-3 py-1 rounded-md text-white float-end w-[150px] h-[44px]"
                    >
                      Submit G1
                    </button>
                  </div>
                </div>
                <div className="col-span-2">
                  <img
                    src={`https://videosroom.com/public/thumbnail/${movie?.thumbnail}`}
                    alt="img"
                  />
                </div>

                <div className="col-span-4 space-y-1 w-full mt-5">
                  <label
                    className={`${labelStyle} flex justify-between w-full items-center`}
                    htmlFor="images"
                  >
                    Banner Image
                    <div className="flex items-center gap-1">
                      Home Page Banner
                      <input
                        type="checkbox"
                        checked={editMovie.isFeatured}
                        onChange={handleIsFeatured}
                      />
                    </div>
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

                  <div className="flex items-center gap-2">
                    <input
                      type="text"
                      onChange={(e) => setGoogleURL(e.target.value)}
                      className={`${inputStyle} h-[44px] bg-green-400`}
                    />
                    <button
                      onClick={(e) => saveThumbnailFromUrl('images', e)}
                      className="my-3 bg-slate-500 px-3 py-1 rounded-md text-white float-end w-[150px] h-[44px]"
                    >
                      Submit G2
                    </button>
                  </div>
                </div>
                <div className="col-span-2">
                  <img
                    src={`https://videosroom.com/public/images/${movie?.images?.[0]?.url}`}
                    alt="img"
                  />
                </div>
              </div>
              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="meta_description">
                    Meta Description
                  </label>
                  <textarea
                    value={editMovie?.meta_description}
                    onChange={onChange}
                    name="meta_description"
                    id="meta_description"
                    placeholder="meta_description"
                    className={inputStyle}
                    rows="2"
                  ></textarea>
                </div>
              </div>
              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="description">
                    Description
                  </label>
                  <textarea
                    value={editMovie?.description}
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
                    Download Link 1
                  </label>
                  <input
                    value={editMovie?.download_link1}
                    onChange={onChange}
                    type="text"
                    name="download_link1"
                    id="download_link1"
                    placeholder="download_link1"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link1"
                  >
                    Iframe Link
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition1"
                        type="number"
                        value={editMovie?.iframePosition1}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link1}
                    onChange={onChange}
                    type="text"
                    name="iframe_link1"
                    id="iframe_link1"
                    placeholder="iframe_link1"
                    className={inputStyle}
                  />
                </div>
              </div>
              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link2">
                    Download Link 2
                  </label>
                  <input
                    value={editMovie?.download_link2}
                    onChange={onChange}
                    type="text"
                    name="download_link2"
                    id="download_link2"
                    placeholder="download_link2"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link2"
                  >
                    Iframe Link 2
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition2"
                        type="number"
                        value={editMovie?.iframePosition2}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link2}
                    onChange={onChange}
                    type="text"
                    name="iframe_link2"
                    id="iframe_link2"
                    placeholder="iframe_link2"
                    className={inputStyle}
                  />
                </div>
              </div>
              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between w-full items-center`}
                  >
                    Download Link 3
                  </label>
                  <input
                    value={editMovie?.download_link3}
                    onChange={onChange}
                    type="text"
                    name="download_link3"
                    id="download_link3"
                    placeholder="download_link3"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link3"
                  >
                    Iframe Link 3
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition3"
                        type="number"
                        value={editMovie?.iframePosition3}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link3}
                    onChange={onChange}
                    type="text"
                    name="iframe_link3"
                    id="iframe_link3"
                    placeholder="iframe_link3"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link4">
                    Download Link 4
                  </label>
                  <input
                    value={editMovie?.download_link4}
                    onChange={onChange}
                    type="text"
                    name="download_link4"
                    id="download_link4"
                    placeholder="download_link4"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link4"
                  >
                    Iframe Link 4
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition4"
                        type="number"
                        value={editMovie?.iframePosition4}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link4}
                    onChange={onChange}
                    type="text"
                    name="iframe_link4"
                    id="iframe_link4"
                    placeholder="iframe_link4"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="download_link5">
                    Download Link 5
                  </label>
                  <input
                    value={editMovie?.download_link5}
                    onChange={onChange}
                    type="text"
                    name="download_link5"
                    id="download_link5"
                    placeholder="download_link5"
                    className={inputStyle}
                  />
                </div>
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link5"
                  >
                    Iframe Link 5
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition5"
                        type="number"
                        value={editMovie?.iframePosition5}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link5}
                    onChange={onChange}
                    type="text"
                    name="iframe_link5"
                    id="iframe_link5"
                    placeholder="iframe_link5"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-4">
                <div className="space-y-1 w-full">
                  <label
                    className={`${labelStyle} flex justify-between w-full items-center`}
                    htmlFor="download_link6"
                  >
                    Download Link 6
                  </label>
                  <input
                    value={editMovie?.download_link6}
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
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link6"
                  >
                    Iframe Link 6 (Rumble)
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition6"
                        type="number"
                        value={editMovie?.iframePosition6}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link6}
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
                    value={editMovie?.download_link7}
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
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link7"
                  >
                    Iframe Link 7
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition7"
                        type="number"
                        value={editMovie?.iframePosition7}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link7}
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
                    value={editMovie?.download_link8}
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
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link8"
                  >
                    Iframe Link 8
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition8"
                        type="number"
                        value={editMovie?.iframePosition8}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link8}
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
                    value={editMovie?.download_link9}
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
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link9"
                  >
                    Iframe Link 9
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition9"
                        type="number"
                        value={editMovie?.iframePosition9}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link9}
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
                    value={editMovie?.download_link10}
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
                    className={`${labelStyle} flex justify-between`}
                    htmlFor="iframe_link10"
                  >
                    Iframe Link 10
                    <div className="flex items-center gap-x-2">
                      Iframe Position
                      <input
                        className="w-[30px] bg-green-300 border border-transparent-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1"
                        onChange={handlePositionChange}
                        name="iframePosition10"
                        type="text"
                        value={editMovie?.iframePosition10}
                      />
                    </div>
                  </label>
                  <input
                    value={editMovie?.iframe_link10}
                    onChange={onChange}
                    type="text"
                    name="iframe_link10"
                    id="iframe_link10"
                    placeholder="iframe_link10"
                    className={inputStyle}
                  />
                </div>
              </div>

              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle} htmlFor="duration">
                    Duration
                  </label>
                  <input
                    value={editMovie?.duration}
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
                    value={editMovie?.director}
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
                    value={editMovie?.uploadBy}
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
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle}>Categories</label>
                  <Select
                    onChange={handleCategoriesChange}
                    defaultValue={PreviousCategories}
                    name="category_ids"
                    isMulti
                    options={categoryOptions}
                  />
                </div>
              </div>
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle}>Quality</label>
                  <Select
                    onChange={handleQuality}
                    defaultValue={PreviousQualtity}
                    name="quality_ids"
                    isMulti
                    options={qualityOptions}
                  />
                </div>
              </div>
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle}>Actors</label>
                  <Select
                    onChange={handleActors}
                    defaultValue={PreviousActors}
                    name="actors_ids"
                    isMulti
                    options={actorOptions}
                  />
                </div>
              </div>
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle}>Actress</label>
                  <Select
                    onChange={handleActress}
                    defaultValue={PreviousActresses}
                    name="actresses_ids"
                    isMulti
                    options={actressOptions}
                  />
                </div>
              </div>
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle}>South Actors</label>
                  <Select
                    onChange={handleSouthActors}
                    defaultValue={PreviouSouthActor}
                    name="south_actor_ids"
                    isMulti
                    options={southActorOptions}
                  />
                </div>
              </div>
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle}>Tags</label>
                  <Select
                    onChange={handleTags}
                    defaultValue={PreviouTags}
                    name="tags_ids"
                    isMulti
                    options={tagOptions}
                  />
                </div>
              </div>
              <div className="flex gap-x-4">
                <div className="space-y-1 w-full">
                  <label className={labelStyle}>Seasons</label>
                  <Select
                    onChange={handleSeasons}
                    defaultValue={PreviousSeasons}
                    name="seasons_ids"
                    isMulti
                    options={seasonOptions}
                  />
                </div>
              </div>
            </div>
          </div>
          <div className="flex justify-end gap-x-2 mt-5">
            <button
              type="submit"
              onClick={editMovieFunc}
              disabled={disabled}
              className="py-2.5 w-24 rounded font-medium text-sm text-white bg-graydark border"
            >
              Edit
            </button>
            <a
              className="py-2.5 w-24 rounded font-medium text-sm text-white bg-green-500 border text-center"
              href={'/'}
            >
              Final
            </a>
          </div>
        </form>
      </DefaultLayout>
    </>
  );
}
