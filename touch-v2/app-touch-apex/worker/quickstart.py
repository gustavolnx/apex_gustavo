# Control of folders in Google Drive
""" 
# ? Juliana Rodrigues
- [X] Scrap por BU
- [ ] Scrap por BU - Valor
# ? Douglas Takayanagi
- [X] Gastos por CC
- [X] Eficiência por CC
- [X] Absorção por CC
- [X] Absorção_Eficiência (Planta)
# ? Thayna Faber
- [X] Energia
- [X] Gás
# ? David
- [X] 5S
- [X] Comunicados
- [X] Comunicados/Aniversariantes
- [X] Opex
- [X] Processos
- [X] Segurança
# ? Sandro Cordeiro
- [X] Scrap (Planta)
"""


# Instructions
# ? (Use Better Comments Extension)
# ? @author lucas_giannone@combovideos.com.br
# * Using Python 3.11.1
# * Using Google Drive API v3
# * This Script serves files from Google Drive to the app


# Imports
import io
from datetime import datetime
import time
import os
import asyncio
from Google import Create_Service
from googleapiclient.http import MediaIoBaseDownload

CLIENT_SECRET_FILE = "credentials.json"
API_NAME = "drive"
API_VERSION = "v3"
SCOPES = ["https://www.googleapis.com/auth/drive"]


# Functions


# * Folder: Drive/EfiAbs
# ! Unused function
async def efiabs(service):
    try:
        # Folder
        folder_id = "1pBY73iB_zS06YWG-vW93GDhWFR8V7UJJ"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- Eficiência - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../csv/efi/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../csv/efi/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Scrap


async def scrap(service):
    try:
        # Folder
        folder_id = "1wxgHG1Q3msuNFv3scavLu0PkRLDU2zcM"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- Scrap - Download %d%%." % int(status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../csv/scrap/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../csv/scrap/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Energia


async def energia(service):
    try:
        # Folder
        folder_id = "1jBdlmbHPvcGB2nfwtCRbLM4nuBxUReOJ"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- Energia - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../csv/ener/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../csv/ener/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Gás


async def gas(service):
    try:
        # Folder
        folder_id = "1rqD-eE9x_UbSMdB59zm1uile9PBno5x0"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- Gás - Download %d%%." % int(status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../csv/gas/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../csv/gas/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Processos


async def processos(service):
    try:
        # Folder
        folder_id = "1HKx6lj-CESU6nMhaJUfQT38t_K4Tggoi"
        folder = f"../pro/scenes/"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false and mimeType='image/png'"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        existing_files = os.listdir(folder)
        drive_files = []
        for i in range(len(files)):
            file_id = files[i]["id"]
            file_name = files[i]["id"]
            index = files[i]["name"].split(".")[-2]
            extension = files[i]["name"].split(".")[-1]
            file_name = f"{index}_{file_name}.{extension}"
            drive_files.append(file_name)
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)

            async def download_file(folder, file_name, request):
                                # Current working dir
                cwd = os.getcwd()
                verify_folder = os.path.abspath(os.path.join(cwd, os.pardir))
                verify_folder = verify_folder+"/pro/scenes/"
                verify_path = f"{verify_folder}{file_name}"
                # Strip spaces
                verify_path = verify_path.replace(" ", "")
                # print(verify_path)
                # print(os.path.exists(verify_path))
                if os.path.exists(verify_path):
                    print(file_name, "- Processos - Already exists.")
                else:
                    fh = io.BytesIO()
                    downloader = MediaIoBaseDownload(fh, request)
                    done = False
                    while done is False:
                        status, done = downloader.next_chunk()
                        print(
                            file_name,
                            "- Processos - Download %d%%." % int(
                                status.progress() * 100),
                        )
                    fh.seek(0)
                    # Save to folder
                    path = f"{folder}{file_name}"
                    with open(path, "wb") as f:
                        f.write(fh.read())

            asyncio.ensure_future(download_file(folder, file_name, request))
        # Remove files that are not in drive
        for filename in existing_files:
            if filename not in drive_files:
                # print(filename,drive_files)
                os.remove(os.path.join(folder, filename))
                print(filename, "- 5S - Removed.")
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Comunicados


async def comunicados(service):
    try:
        # Folder
        folder_id = "1eV2AoEsAPeOkj7zAmqzLyksBtH1_LkEa"
        folder = f"../com/files/"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false and mimeType!='application/vnd.google-apps.folder'"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        existing_files = os.listdir(folder)
        drive_files = []
        for i in range(len(files)):
            file_id = files[i]["id"]
            file_name = files[i]["id"]
            extension = files[i]["name"].split(".")[-1]
            file_name = file_name + "." + extension
            drive_files.append(file_name)            
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)

            async def download_file(folder, file_name, request):
                # Current working dir
                cwd = os.getcwd()
                verify_folder = os.path.abspath(os.path.join(cwd, os.pardir))
                verify_folder = verify_folder+"/com/files/"
                verify_path = f"{verify_folder}{file_name}"
                # Strip spaces
                verify_path = verify_path.replace(" ", "")
                # print(verify_path)
                # print(os.path.exists(verify_path))
                if os.path.exists(verify_path):
                    print(file_name, "- Comunicados - Already exists.")
                else:
                    fh = io.BytesIO()
                    downloader = MediaIoBaseDownload(fh, request)
                    done = False
                    while done is False:
                        status, done = downloader.next_chunk()
                        print(
                            file_name,
                            "- Comunicados - Download %d%%." % int(
                                status.progress() * 100),
                        )
                    fh.seek(0)
                    # Save to folder
                    path = f"{folder}{file_name}"
                    with open(path, "wb") as f:
                        f.write(fh.read())

            asyncio.ensure_future(download_file(folder, file_name, request))
        # Remove files that are not in drive
        for filename in existing_files:
            if filename not in drive_files:
                # print(filename,drive_files)
                os.remove(os.path.join(folder, filename))
                print(filename, "- 5S - Removed.")

    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Comunicados/Aniversariantes


# async def aniversariantes(service):
#     try:
#         # Folder
#         folder_id = "1vXl-TYhbByWMymzLGBs36lfDNxkWgsHB"
#         folder = f"../com/files/aniversariantes/"
#         # Get all files from folder
#         query = f"'{folder_id}' in parents and trashed=false and mimeType='application/vnd.google-apps.folder'"
#         folders = (
#             service.files()
#             .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
#             .execute()
#         )
#         drivefolders = folders.get("files", [])
#         # For each folder, get files in it
#         for drivefolder in drivefolders:
#             query = f"'{drivefolder['id']}' in parents and trashed=false and mimeType!='application/vnd.google-apps.folder'"
#             files = (
#                 service.files()
#                 .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
#                 .execute()
#             )
#             files = files.get("files", [])
#             # print(files)
#             # List local folders
#             local_folders = os.listdir(folder)
#             for i in range(len(local_folders)):
#                 # If is the same name, remove all files
#                 if local_folders[i] == drivefolder["name"]:
#                     # print('Cleared ' + drivefolder['name'])
#                     for filename in os.listdir(f"{folder}{local_folders[i]}"):
#                         # If file is not a folder
#                         if os.path.isfile(
#                             os.path.join(
#                                 f"{folder}{local_folders[i]}", filename)
#                         ):
#                             os.remove(
#                                 os.path.join(
#                                     f"{folder}{local_folders[i]}", filename)
#                             )
#                 if not os.path.exists(f"{folder}{drivefolder['name']}"):
#                     print("Created " + drivefolder["name"])
#                     os.makedirs(f"{folder}{drivefolder['name']}")

#             for i in range(len(files)):
#                 file_id = files[i]["id"]
#                 file_name = files[i]["name"]
#                 folder2 = drivefolder["name"]
#                 # Download from drive using file_id
#                 request = service.files().get_media(fileId=file_id)

#                 async def download_file(folder, folder2, file_name, request):
#                     fh = io.BytesIO()
#                     downloader = MediaIoBaseDownload(fh, request)
#                     done = False
#                     while done is False:
#                         status, done = downloader.next_chunk()
#                         print(
#                             folder2,
#                             "- Aniversariantes - Download %d%%."
#                             % int(status.progress() * 100),
#                         )
#                     fh.seek(0)
#                     # Save to folder
#                     path = f"{folder}{folder2}/{file_name}"
#                     with open(path, "wb") as f:
#                         f.write(fh.read())

#                 asyncio.ensure_future(
#                     download_file(folder, folder2, file_name, request)
#                 )
#     except Exception as e:
#         with open("log.txt", "a") as f:
#             f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
#         print(e)


# * Folder: Drive/Opex


async def opex(service):
    try:
        folder_id = "1b7oYrjo_8UT3STVt7L99BjoogYhd7JGA"
        folder = f"../ope/scenes/"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false and mimeType!='application/vnd.google-apps.folder'"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        existing_files = os.listdir(folder)
        drive_files = []
        for i in range(len(files)):
            file_id = files[i]["id"]
            file_name = files[i]["id"]
            extension = files[i]["name"].split(".")[-1]
            file_name = file_name + "." + extension
            drive_files.append(file_name)
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)

            async def download_file(folder, file_name, request):
                                # Current working dir
                cwd = os.getcwd()
                verify_folder = os.path.abspath(os.path.join(cwd, os.pardir))
                verify_folder = verify_folder+"/ope/scenes/"
                verify_path = f"{verify_folder}{file_name}"
                # Strip spaces
                verify_path = verify_path.replace(" ", "")
                # print(verify_path)
                # print(os.path.exists(verify_path))
                if os.path.exists(verify_path):
                    print(file_name, "- Opex - Already exists.")
                else:
                    fh = io.BytesIO()
                    downloader = MediaIoBaseDownload(fh, request)
                    done = False
                    while done is False:
                        status, done = downloader.next_chunk()
                        print(
                            file_name,
                            "- Opex - Download %d%%." % int(
                                status.progress() * 100),
                        )
                    fh.seek(0)
                    # Save to folder
                    path = f"{folder}{file_name}"
                    with open(path, "wb") as f:
                        f.write(fh.read())
            asyncio.ensure_future(download_file(folder, file_name, request))
        # Remove files that are not in drive
        for filename in existing_files:
            if filename not in drive_files:
                # print(filename,drive_files)
                os.remove(os.path.join(folder, filename))
                print(filename, "- 5S - Removed.")
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Manutenção


async def manutencao(service):
    try:
        # Folder
        folder_id = "1_LUEwz5cFcvG2b6OIRW5OUVFlIe9JVHD"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- Manutenção - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../man/csv/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../man/csv/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Geral/Abosrção_Eficiência_Gastos (Planta)


async def efiabsv2(service):
    try:
        # Folder
        folder_id = "1uVh_9eW3XIVBMEI8Vnowfh8PH-cvo-g_"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- EFI ABS GASTOS - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../../app/setores/worker/csv/gastos/all/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../../app/setores/worker/csv/gastos/all/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Absorção por CC


async def buabs(service):
    try:
        # Folder
        folder_id = "1V5QWoLChHO5xHHOXbR1GuJK8yVYgZJ1c"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- ABS POR BU - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../../app/setores/worker/csv/absorcao/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../../app/setores/worker/csv/absorcao/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Eficiência por CC


async def buefi(service):
    try:
        # Folder
        folder_id = "1IXhCoZg_upk-_uygabeimGGp9TqGAilg"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- EFI POR BU - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../../app/setores/worker/csv/eficiencia/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../../app/setores/worker/csv/eficiencia/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/Gastos por Conta


async def buspend(service):
    try:
        # Folder
        folder_id = "1L6dCs-T6lSmVXhNRSppFAPotYOfPhfKw"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- GASTOS POR BU - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../../app/setores/worker/csv/gastos/bu/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../../app/setores/worker/csv/gastos/bu/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# ? 1UnoUNI97LP4FBAPir97nh11WPuEVMTjM

# * Folder: Drive/Scrap por BU


async def buscrap(service):
    try:
        # Folder
        folder_id = "1UnoUNI97LP4FBAPir97nh11WPuEVMTjM"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- SCRAP POR BU - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../../app/setores/worker/csv/scrap/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../../app/setores/worker/csv/scrap/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# ? 19hA0hUKHWKcnHsbpUNZv85jzvvL6CG-c

# * Folder: Drive/Scrap por BU - Valor


async def buscrapval(service):
    try:
        # Folder
        folder_id = "19hA0hUKHWKcnHsbpUNZv85jzvvL6CG-c"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        for i in range(len(files)):
            file_id = files[i]["id"]
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            fh = io.BytesIO()
            downloader = MediaIoBaseDownload(fh, request)
            done = False
            while done is False:
                status, done = downloader.next_chunk()
                print(
                    files[i]["name"],
                    "- SCRAP POR BU R$ - Download %d%%." % int(
                        status.progress() * 100),
                )
            fh.seek(0)
            folder = f"../../app/setores/worker/csv/scrapval/"
            # Empty folder
            for filename in os.listdir(folder):
                os.remove(os.path.join(folder, filename))
            # Save to folder
            path = f"../../app/setores/worker/csv/scrapval/{files[i]['name']}"
            with open(path, "wb") as f:
                f.write(fh.read())
    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# * Folder: Drive/5S

async def S5(service):
    try:
        folder_id = "1LsPrHjQp0_vXDS3gHmW-wkSNlIUaPMer"
        folder = f"../5s/scenes/"
        # Get all files from folder
        query = f"'{folder_id}' in parents and trashed=false and mimeType!='application/vnd.google-apps.folder'"
        files = (
            service.files()
            .list(q=query, supportsAllDrives=True, includeItemsFromAllDrives=True)
            .execute()
        )
        files = files.get("files", [])
        existing_files = os.listdir(folder)
        drive_files = []
        for i in range(len(files)):
            file_id = files[i]["id"]
            file_name = files[i]["id"]
            index = files[i]["name"].split(".")[-2]
            extension = files[i]["name"].split(".")[-1]
            file_name = f"{index}_{file_name}.{extension}"
            drive_files.append(file_name)
            # Download from drive using file_id
            request = service.files().get_media(fileId=file_id)
            # Async download
            async def download_file(folder, file_name, request):
                # Current working dir
                cwd = os.getcwd()
                verify_folder = os.path.abspath(os.path.join(cwd, os.pardir))
                verify_folder = verify_folder+"/5s/scenes/"
                verify_path = f"{verify_folder}{file_name}"
                # Strip spaces
                verify_path = verify_path.replace(" ", "")
                # print(verify_path)
                # print(os.path.exists(verify_path))
                if os.path.exists(verify_path):
                    print(file_name, "- 5S - Already exists.")
                else:
                    fh = io.BytesIO()
                    downloader = MediaIoBaseDownload(fh, request)
                    done = False
                    while done is False:
                        status, done = downloader.next_chunk()
                        print(
                            file_name,
                            "- 5S - Download %d%%." % int(status.progress() * 100),
                        )
                    fh.seek(0)
                    # Save to folder
                    path = f"{folder}{file_name}"
                    with open(path, "wb") as f:
                        f.write(fh.read())
            asyncio.ensure_future(download_file(folder, file_name, request))
        # Remove files that are not in drive
        for filename in existing_files:
            if filename not in drive_files:
                # print(filename,drive_files)
                os.remove(os.path.join(folder, filename))
                print(filename, "- 5S - Removed.")


    except Exception as e:
        with open("log.txt", "a") as f:
            f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
        print(e)


# ? Main function


async def main():

    now = datetime.now().strftime("%H")
    print(datetime.now().strftime("%H:%M"))
    # Create service
    service = Create_Service(CLIENT_SECRET_FILE, API_NAME, API_VERSION, SCOPES)
    
    await asyncio.gather(buefi(service))
    # await asyncio.gather(buscrapval(service), buscrap(service), buspend(service), buefi(service), buabs(service), efiabsv2(service), energia(service), gas(service), scrap(service), manutencao(service))
    # await asyncio.gather(S5(service), opex(service), comunicados(service), processos(service))
    print("Script finished")
    time.sleep(900)


# ? Utility Functions


def checkGitUpd():
    # Run git fetch, if there is a new commit, pull
    try:
        fetch = os.system("git fetch")
        if fetch > 0:
            try:
                os.system("git pull")
                print("Git updated.")
            except:
                print("Error on git pull")
                # Log it
                with open("log.txt", "a") as f:
                    f.write(
                        f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-Error on git pull"
                    )
                pass
        else:
            print("Git already up to date.")
    except:
        print("Error on git fetch")
        # Log it
        with open("log.txt", "a") as f:
            f.write(
                f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-Error on git fetch")
        pass
    # If success write to log
    with open("log.txt", "a") as f:
        f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-Git updated")


def DailyRestart():
    # Restart computer at 06:00
    now = datetime.now().strftime("%H")
    if now == "06":
        try:
            # Try to restart computer
            os.system("shutdown /r /t 1")
            print("Restarting computer...")
        except:
            # If error, write to log
            with open("log.txt", "a") as f:
                f.write(
                    f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-Error on restart"
                )
    else:
        print("Waiting for 06:00...")
        # If success write to log
        with open("log.txt", "a") as f:
            f.write(
                f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}- Computer not restarted"
            )


def TerminateExplorer():
    try:
        # Try to terminate explorer.exe
        os.system("taskkill /f /im explorer.exe")
        print("Terminating explorer.exe...")
    except:
        # If error, write to log
        with open("log.txt", "a") as f:
            f.write(
                f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-Error on terminate explorer.exe"
            )


# ? PROGRAM EXECUTION
if __name__ == "__main__":
    # Each 30 minutes check if computer time is equal to 09:00
    while True:
        try:
            # DailyRestart()
            # TerminateExplorer()
            # checkGitUpd()
            asyncio.run(main())
            print("Waiting...")
        except Exception as e:
            # Write to log
            with open("log.txt", "a") as f:
                f.write(f"\n{datetime.now().strftime('%d/%m/%Y %H:%M')}-{e}")
            print(e)
            print("Waiting...")
            time.sleep(1800)
